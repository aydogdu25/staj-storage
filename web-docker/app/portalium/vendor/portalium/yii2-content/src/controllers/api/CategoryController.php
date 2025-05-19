<?php

namespace portalium\content\controllers\api;

use portalium\content\models\CategorySearch;
use Yii;
use portalium\content\Module;
use portalium\content\models\Content;
use portalium\rest\ActiveController as RestActiveController;

class CategoryController extends RestActiveController
{
    public $modelClass = 'portalium\content\models\Category';
    
    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['dataFilter'] = [
            'class' => \yii\data\ActiveDataFilter::class,
            'searchModel' => $this->modelClass,
        ];

        //before index data filter
        $actions['index']['prepareDataProvider'] = function ($action) {
            $searchModel = new CategorySearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            if(!Yii::$app->user->can('contentApiCategoryIndex')){
                $dataProvider->query->andWhere(['id_user'=>Yii::$app->user->id]);
            }
            return $dataProvider;
        };  

        return $actions;
    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        switch ($action->id) {
            case 'view':
                if (!Yii::$app->user->can('contentApiCategoryView')) 
                    throw new \yii\web\ForbiddenHttpException(Module::t('You do not have permission to view this content.'));
                break;
            case 'create':
                if (!Yii::$app->user->can('contentApiCategoryCreate')) 
                    throw new \yii\web\ForbiddenHttpException(Module::t('You do not have permission to create this content.'));
                break;
            case 'update':
                if (!Yii::$app->user->can('contentApiCategoryUpdate')) 
                    throw new \yii\web\ForbiddenHttpException(Module::t('You do not have permission to update this content.'));
                break;
            case 'delete':
                if (!Yii::$app->user->can('contentApiCategoryDelete'))
                    throw new \yii\web\ForbiddenHttpException(Module::t('You do not have permission to delete this content.'));
                break;
            case 'index':
                if (!Yii::$app->user->can('contentApiCategoryIndex') && !Yii::$app->user->can('contentApiCategoryIndexOwn'))
                    throw new \yii\web\ForbiddenHttpException(Module::t('You do not have permission to view this content.'));
                break;
        }
        
        return true;
    }
}