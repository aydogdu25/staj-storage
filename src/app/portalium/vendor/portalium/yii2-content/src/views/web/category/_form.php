<?php

use yii\helpers\Html;
use portalium\content\Module;
use portalium\theme\widgets\Panel;
use portalium\theme\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model portalium\content\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php Panel::begin([
        'title' => Html::encode($this->title),
        'actions' => [
            'header' => [
            ],
            'footer' => [
                Html::submitButton(Module::t( 'Save'), ['class' => 'btn btn-success']),
            ]
        ],
    ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?php Panel::end() ?>

    <?php ActiveForm::end(); ?>

</div>
