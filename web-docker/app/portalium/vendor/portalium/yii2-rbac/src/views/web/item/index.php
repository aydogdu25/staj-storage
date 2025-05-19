<?php

use yii\helpers\Url;
use yii\helpers\Html;
use portalium\rbac\Module;
use portalium\theme\widgets\Panel;
use portalium\theme\widgets\GridView;
use portalium\theme\widgets\ActionColumn;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $context portalium\user\components\BaseAuthItemController */
/* @var $searchModel portalium\user\models\auth\search\AuthItemSearch */

$context = $this->context;
$labels = $context->labels();
$this->title = Module::t($labels['Items']);
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Panel::begin([
    'title' => Html::encode($this->title),
    'actions' => [
        'header' => [
            ($this->context->getType() === 2) ? "" : Html::a(
                Module::t(''),
                ['create'],
                ['class' => 'fa fa-plus btn btn-success']
            ),
        ],
    ],
])?>
    <?php
$buttonsKeyArray = [];

if ($this->context->getType() === 2) {
    $buttonsKeyArray['delete'] = function ($url, $model) {
        return null;
    };
    $buttonsKeyArray['update'] = function ($url, $model) {
        return null;
    };
}

$buttonsKeyArray['bulkAssignment'] = function ($url, $model) {
    return Html::a(
        Html::tag('i', '', ['class' => 'fa fa-fw fa-cog']), 
        Url::toRoute(['/rbac/bulk-assignment', 'id' => $model->name]),
        ['class' => 'btn btn-primary btn-xs', 'style' => 'padding: 2px 9px 2px 9px; display: inline-block;'] 
    );
};

?>
    <?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'layout' => '{items}{summary}{pagesizer}{pager}',
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
        ],
        [
            'attribute' => 'name',
            'label' => Module::t('Name'),
        ],
        [
            'attribute' => 'description',
            'label' => Module::t('Description'),
        ],
        [
            'class' => ActionColumn::class,
            'template' => '{view} {update} {bulkAssignment} {delete}',
            'buttons' => $buttonsKeyArray,
        ],
    ],
])
?>
<?php Panel::end()?>
