<?php

use yii\helpers\Url;
use yii\helpers\Html;
use portalium\content\Module;
use portalium\theme\widgets\Panel;
use portalium\theme\widgets\GridView;
use portalium\theme\widgets\ActionColumn;
/* @var $this yii\web\View */
/* @var $searchModel portalium\content\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <?php Panel::begin([
        'title' => $this->title,
        'actions' => [
            Html::a(Module::t(''), ['create'], ['class' => 'fa fa-plus btn btn-success'])
        ]
    ]) ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id_category',
            'name',
            'slug',
            'date_create',
            'date_update',
            ['class' => ActionColumn::class],
        ],
        'layout' => '{items}{summary}{pagesizer}{pager}',
    ]); Panel::end() ?>


</div>
