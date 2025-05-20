<?php

namespace portalium\rbac\controllers\web;

use Yii;
use yii\rbac\Item;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use portalium\rbac\components\BaseAuthItemController;
use portalium\rbac\Module;

/**
 * PermissionController implements the CRUD actions for AuthItem model.
 */
class PermissionController extends BaseAuthItemController
{

    /**
     * @inheritdoc
     */
    public function labels()
    {
        return [
            'Item' => 'Permission',
            'Items' => 'Permissions',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return Item::TYPE_PERMISSION;
    }

    /**
     * {@inheritdoc}
     */
    public function actionCreate()
    {
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * {@inheritdoc}
     */
    public function actionDelete($id)
    {
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * {@inheritdoc}
     */
    public function actionUpdate($id)
    {
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * {@inheritdoc}
     */
    public function getViewPath()
    {
        if (!Yii::$app->user->can('rbacWebPermissionViewPath')) {
            throw new ForbiddenHttpException(Module::t("Sorry you are not allowed to set Permission"));
        }

        return '@portalium/' . $this->module->id . '/views/' . Yii::$app->id . '/item';
    }
}
