<?php

use yii\helpers\Html;
use portalium\content\Module;
use kartik\editors\Summernote;
use portalium\theme\widgets\Panel;
use portalium\content\models\Content;
use portalium\content\models\Category;
use portalium\theme\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model portalium\content\models\Content */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-form">

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

    <?= $form->field($model, 'title')->textInput(['rows' => 6]) ?>

    <?= $form->field($model, 'body')->widget(Summernote::class) ?>

    <?= $form->field($model, 'id_category')->dropDownList(Category::getCategoryList())->label('Category') ?>

    <?= $form->field($model, 'status')->dropDownList(Content::getStatusList()['STATUS']) ?>

    <?= $form->field($model, 'layout')->dropDownList(\yii\helpers\ArrayHelper::map(\portalium\theme\Module::getLayouts(), 'layout', 'name')) ?>

    <?= $form->field($model, 'access')->dropDownList(Content::getStatusList()['ACCESS']) ?>


    <?php Panel::end() ?>

    <?php ActiveForm::end(); ?>

</div>
