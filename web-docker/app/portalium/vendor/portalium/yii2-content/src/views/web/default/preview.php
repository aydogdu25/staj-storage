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
    ]) ?>
    <?php
    echo Html::decode($model->body);
    ?>
    <?php

    Panel::end() ?>

</div>