<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use portalium\content\models\Content;
use portalium\content\Module;
use portalium\theme\widgets\Panel;
/* @var $this yii\web\View */
/* @var $model portalium\content\models\Content */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Module::t('Contents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-view">

    <?php Panel::begin([
        'title' => $this->title,
        'actions' => [
            Html::a(Module::t(''), ['update', 'id' => $model->id_content], ['class' => 'btn btn-primary fa fa-pencil']),
            Html::a(Module::t(''), ['delete', 'id' => $model->id_content], [
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
            'title:ntext',
            [
                'attribute' => 'status',
                'value' => Content::getStatusList()['STATUS'][$model->status],
            ],
            'date_create',
            'date_update',
        ],
    ]); Panel::end() ?>

</div>
