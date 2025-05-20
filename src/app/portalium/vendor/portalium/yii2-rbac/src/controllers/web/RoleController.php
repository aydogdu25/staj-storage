<?php

namespace portalium\rbac\controllers\web;

use Yii;
use yii\rbac\Item;
use yii\web\ForbiddenHttpException;
use portalium\rbac\components\BaseAuthItemController;
use portalium\rbac\Module;

/**
 * RoleController implements the CRUD actions for AuthItem model.
 *
 */
class RoleController extends BaseAuthItemController
{
    /**
     * @inheritdoc
     */
    public function labels()
    {
        return [
            'Item' => 'Role',
            'Items' => 'Roles',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return Item::TYPE_ROLE;
    }

    public function getViewPath()
    {
        if (!Yii::$app->user->can('rbacWebRoleViewPath')) {
            throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }

        return '@portalium/' . $this->module->id . '/views/' . Yii::$app->id . '/item';
    }
}
