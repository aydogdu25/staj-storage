<?php

use yii\helpers\Html;
use portalium\content\Module;
use portalium\theme\widgets\Panel;
/* @var $this yii\web\View */
/* @var $model portalium\content\models\Category */

$this->title = Module::t('Update Category: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Module::t('Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id_category]];
$this->params['breadcrumbs'][] = Module::t('Update');
?>
<div class="category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
