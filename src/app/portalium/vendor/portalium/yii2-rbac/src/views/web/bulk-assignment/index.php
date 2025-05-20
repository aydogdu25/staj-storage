<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\YiiAsset;
use portalium\rbac\Module;
use portalium\theme\widgets\Panel;

/* @var $this yii\web\View */

$itemType = null;

switch ($model->getItem()->type) {
    case 1:
        $itemType = Module::t('Roles');
        $itemUrl = '/rbac/role';
        break;
    case 2:
        $itemType = Module::t('Permissions');
        $itemUrl = '/rbac/permission';
        break;
}

$this->title = Module::t('Bulk Assignment') . ' : ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => $itemType, 'url' => [$itemUrl]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => [$itemUrl . '/view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = Module::t('Bulk Assignment');

YiiAsset::register($this);

$opts = Json::htmlEncode([
    'items' => $model->getItems(),
    'users' => $userDataProvider->query->select(['id_user', 'username'])->all(),
    'groups' => $groupDataProvider->query->select(['id_group', 'name'])->all(),
    'assignedUsers' => $assignedUsers,
]);

$optgroupLabels = Json::htmlEncode([
    'allUsers' => Module::t('All Users'),
    'allGroups' => Module::t('All Groups'),
    'assignedUsers' => Module::t('Assigned Users'),
]);

$this->registerJs("var _opts = {$opts};");
$this->registerJs("var optgroupLabels = {$optgroupLabels};");

$this->registerJs($this->render('_script.js'));
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
?>
<?php Panel::begin([
    'title' => $this->title,
]) ?>
    <div class="row">
        <div class="col-sm-5">
            <input class="form-control search" data-target="available"
                   placeholder="<?= Module::t('Search for available'); ?>">
            <select multiple size="20" class="form-control list" data-target="available">
            </select>
        </div>
        <div class="col-sm-2" style="text-align: center">
            <div class="text-center" style="position: relative; top: 50%;">
                <div class="btn-group-vertical" style="transform: translateY(-50%);">
                    <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-arrow-right']) . $animateIcon, ['assign', 'id' => (string)$model->name], [
                        'class' => 'btn btn-success btn-assign',
                        'title' => Module::t('Assign'),
                    ]); ?>
                    <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-arrow-left']) . $animateIcon, ['revoke', 'id' => (string)$model->name], [
                        'class' => 'btn btn-danger btn-assign',
                        'title' => Module::t('Remove'),
                    ]); ?>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <input class="form-control search" data-target="assigned"
                   placeholder="<?= Module::t('Search for assigned'); ?>">
            <select multiple size="20" class="form-control list" data-target="assigned">
            </select>
        </div>
    </div>
<?php Panel::end() ?>