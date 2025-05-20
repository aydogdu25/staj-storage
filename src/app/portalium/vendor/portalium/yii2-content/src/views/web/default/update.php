<?php

use yii\helpers\Html;
use portalium\content\models\Content;
use portalium\content\Module;
use portalium\theme\widgets\Panel;
/* @var $this yii\web\View */
/* @var $model portalium\content\models\Content */

$this->title = Module::t('Update Content: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Module::t('Contents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id_content]];
$this->params['breadcrumbs'][] = Module::t('Update');
?>
<div class="content-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
