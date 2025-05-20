<?php

use yii\helpers\Html;
use portalium\theme\widgets\ActiveForm;
use portalium\content\Module;

/* @var $this yii\web\View */
/* @var $model portalium\content\models\ContentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_content') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'body') ?>

    <?= $form->field($model, 'id_user') ?>

    <?php // echo $form->field($model, 'id_category') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'date_create') ?>

    <?php // echo $form->field($model, 'date_update') ?>

    <div class="form-group">
        <?= Html::submitButton(Module::t('Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Module::t('Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
