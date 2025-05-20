<?php

namespace portalium\content\controllers\web;

use Yii;
use portalium\content\models\Content;
use portalium\content\models\ContentSearch;
use portalium\web\Controller;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use portalium\content\Module;

/**
 * ContentController implements the CRUD actions for Content model.
 */
class DefaultController extends Controller
{
    /* public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['access']['except'] = ['index'];
        return $behaviors;
    } */
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['access']['except'] = ['show'];
        $behaviors['verbs']['class'] = VerbFilter::className();
        $behaviors['verbs']['actions']['delete'] = ['POST'];

        return $behaviors;
    }

    /**
     * Lists all Content models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!\Yii::$app->user->can('contentWebDefaultIndex') && !\Yii::$app->user->can('contentWebDefaultIndexOwn')) {
            throw new \yii\web\ForbiddenHttpException(Module::t('You are not allowed to access this page.'));
        }

        $searchModel = new ContentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if(!\Yii::$app->user->can('contentWebDefaultIndex'))
            $dataProvider->query->andWhere(['id_user'=>\Yii::$app->user->id]);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Content model.
     * @param int $id_content Id Content
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if ($model && !\Yii::$app->user->can('contentWebDefaultView', ['model' => $model])) {
            throw new \yii\web\ForbiddenHttpException(Module::t('You are not allowed to access this page.'));
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Content model.
     * @param int $id_content Id Content
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPreview($id)
    {
        if (!\Yii::$app->user->can('contentWebDefaultPreview', ['model' => $this->findModel($id)])) {
            throw new \yii\web\ForbiddenHttpException(Module::t('You are not allowed to access this page.'));
        }
        return $this->render('preview', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Content model.
     * @param int $id_content Id Content
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionShow($id)
    {

        $model = $this->findModel($id);
        if ($model->access != Content::ACCESS['public'] && !\Yii::$app->user->can('contentWebDefaultShow', ['model' => $this->findModel($id)])) {
            throw new \yii\web\ForbiddenHttpException(Module::t('You are not allowed to access this page.'));
        }

        if ($model && $model->layout != 'null') {
            $this->layout = '@portalium/theme/layouts/' . $model->layout;
        }

        return $this->render('show', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Content model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (!\Yii::$app->user->can('contentWebDefaultCreate')) {
            throw new \yii\web\ForbiddenHttpException(Module::t('You are not allowed to access this page.'));
        }
        $model = new Content();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->addFlash('success', Module::t('Content has been created'));
                return $this->redirect(['view', 'id' => $model->id_content]);
            }
        } else {
            $model->loadDefaultValues();
        }


        return $this->render('create', [
            'model' => $model,
            'layouts' => $this->getLayouts()
        ]);
    }

    /**
     * Updates an existing Content model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_content Id Content
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!\Yii::$app->user->can('contentWebDefaultUpdate', ['model' => $this->findModel($id)])) {
            throw new \yii\web\ForbiddenHttpException(Module::t('You are not allowed to access this page.'));
        }
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->addFlash('success', Module::t('Content has been updated'));
            return $this->redirect(['view', 'id' => $model->id_content]);
        }

        return $this->render('update', [
            'model' => $model,
            'layouts' => $this->getLayouts()
        ]);
    }

    /**
     * Deletes an existing Content model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_content Id Content
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (!\Yii::$app->user->can('contentWebDefaultDelete', ['model' => $this->findModel($id)])) {
            throw new \yii\web\ForbiddenHttpException(Module::t('You are not allowed to access this page.'));
        }
        if($this->findModel($id)->delete()){
            Yii::$app->session->addFlash('info', Module::t('Content has been deleted'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Content model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_content Id Content
     * @return Content the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_content)
    {
        if (($model = Content::findOne(['id_content' => $id_content])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Module::t('The requested page does not exist.'));
    }

    private function getLayouts()
    {
        return \yii\helpers\ArrayHelper::map(\portalium\theme\Module::getLayouts(), 'name', 'layout');
    }
}
