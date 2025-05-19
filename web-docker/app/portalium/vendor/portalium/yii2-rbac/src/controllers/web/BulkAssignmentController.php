<?php

namespace portalium\rbac\controllers\web;

use Yii;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use portalium\rbac\components\BulkAuthAssignmentHelper;
use portalium\rbac\models\Assignment;
use portalium\rbac\models\AuthItem;
use portalium\rbac\Module;
use portalium\user\models\GroupSearch;
use portalium\user\models\UserSearch;
use portalium\web\Controller as WebController;

/**
 * Bulk Assignment Controller
 */
class BulkAssignmentController extends WebController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'assign' => ['post'],
                    'revoke' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        Yii::$app->view->registerJs(
            "
            $.ajaxSetup({
                beforeSend: function(xhr){
                    this.data += '&' + $.param({
                        '" . Yii::$app->request->csrfParam . "': '" . Yii::$app->request->getCsrfToken() . "'
                    });
                }
                });
            "
        );

        return parent::beforeAction($action);
    }

    /**
     * @return mixed
     */
    public function actionIndex($id)
    {
        if (!Yii::$app->user->can('rbacWebBulkAssignmentIndex')) {
            throw new ForbiddenHttpException(Module::t("Sorry you are not allowed to set Assignment"));
        }

        $model = $this->findModel($id);
        return $this->render('index', [
            'groupDataProvider' => (new GroupSearch())->search($this->request->queryParams),
            'userDataProvider' => (new UserSearch())->search($this->request->queryParams),
            'assignedUsers' => BulkAuthAssignmentHelper::getAssignedUsers($id)->select(['id_user', 'username'])->all(),
            'model' => $model,
        ]);
    }

    /**
     * @param string $id
     * @return array
     */
    public function actionAssign($id)
    {
        if (!Yii::$app->user->can('rbacWebBulkAssignmentAssign')) {
            throw new ForbiddenHttpException(Module::t("Sorry you are not allowed to set Assignment"));
        }

        $success = BulkAuthAssignmentHelper::assignByMixed($id, $this->request->post('items', []));
        Yii::$app->getResponse()->format = 'json';
        return array_merge(['assignedUsers' => BulkAuthAssignmentHelper::getAssignedUsers($id)->select(['id_user', 'username'])->all()], ['success' => $success]);
    }

    /**
     * @param string $id
     * @return array
     */
    public function actionRevoke($id)
    {
        if (!Yii::$app->user->can('rbacWebBulkAssignmentRevoke')) {
            throw new ForbiddenHttpException(Module::t("Sorry you are not allowed to set Assignment"));
        }

        $success = BulkAuthAssignmentHelper::revokeByMixed($id, $this->request->post('items', []));
        Yii::$app->getResponse()->format = 'json';
        return array_merge(['assignedUsers' => BulkAuthAssignmentHelper::getAssignedUsers($id)->select(['id_user', 'username'])->all()], ['success' => $success]);
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param  integer $id
     * @return Assignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::find($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
