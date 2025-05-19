<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use portalium\content\Module;
use portalium\theme\widgets\Panel;
/* @var $this yii\web\View */
/* @var $model portalium\content\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Module::t('Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="category-view">
    <?php Panel::begin([
        'title' => $this->title,
        'actions' => [
            Html::a(Module::t(''), ['update', 'id' => $model->id_category], ['class' => 'btn btn-primary fa fa-pencil']),
            Html::a(Module::t(''), ['delete', 'id' => $model->id_category], [
                'class' => 'btn btn-danger fa fa-trash',
                'data' => [
                    'confirm' => Module::t('Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
        ]
    ]) ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'date_create',
            'date_update',
        ],
    ]); Panel::end() ?>
</div>
