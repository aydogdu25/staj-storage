<?php
use portalium\db\Migration;

class m010101_010105_rbac extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        $role = Yii::$app->setting->getValue('site::admin_role');
        $admin = (isset($role) && $role != '') ? $auth->getRole($role) : $auth->getRole('admin');

        $rbacWebAssignmentView = $auth->createPermission('rbacWebAssignmentView');
        $rbacWebAssignmentView->description = 'RBAC Web Assignment View';
        $auth->add($rbacWebAssignmentView);
        $auth->addChild($admin, $rbacWebAssignmentView);

        $rbacWebAssignmentAssign = $auth->createPermission('rbacWebAssignmentAssign');
        $rbacWebAssignmentAssign->description = 'RBAC Web Assignment Assign';
        $auth->add($rbacWebAssignmentAssign);
        $auth->addChild($admin, $rbacWebAssignmentAssign);

        $rbacWebAssignmentRevoke = $auth->createPermission('rbacWebAssignmentRevoke');
        $rbacWebAssignmentRevoke->description = 'RBAC Web Assignment Revoke';
        $auth->add($rbacWebAssignmentRevoke);
        $auth->addChild($admin, $rbacWebAssignmentRevoke);

        $rbacWebBulkAssignmentIndex = $auth->createPermission('rbacWebBulkAssignmentIndex');
        $rbacWebBulkAssignmentIndex->description = 'RBAC Web Bulk Assignment Index';
        $auth->add($rbacWebBulkAssignmentIndex);
        $auth->addChild($admin, $rbacWebBulkAssignmentIndex);

        $rbacWebBulkAssignmentAssign = $auth->createPermission('rbacWebBulkAssignmentAssign');
        $rbacWebBulkAssignmentAssign->description = 'RBAC Web Bulk Assignment Assign';
        $auth->add($rbacWebBulkAssignmentAssign);
        $auth->addChild($admin, $rbacWebBulkAssignmentAssign);

        $rbacWebBulkAssignmentRevoke = $auth->createPermission('rbacWebBulkAssignmentRevoke');
        $rbacWebBulkAssignmentRevoke->description = 'RBAC Web Bulk Assignment Revoke';
        $auth->add($rbacWebBulkAssignmentRevoke);
        $auth->addChild($admin, $rbacWebBulkAssignmentRevoke);

        $rbacWebPermissionViewPath = $auth->createPermission('rbacWebPermissionViewPath');
        $rbacWebPermissionViewPath->description = 'RBAC Web Permission View Path';
        $auth->add($rbacWebPermissionViewPath);
        $auth->addChild($admin, $rbacWebPermissionViewPath);

        $rbacWebRoleViewPath = $auth->createPermission('rbacWebRoleViewPath');
        $rbacWebRoleViewPath->description = 'View RBAC Web Role View Path';
        $auth->add($rbacWebRoleViewPath);
        $auth->addChild($admin, $rbacWebRoleViewPath);

    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->remove($auth->getPermission('rbacWebAssignmentView'));
        $auth->remove($auth->getPermission('rbacWebAssignmentAssign'));
        $auth->remove($auth->getPermission('rbacWebAssignmentRevoke'));
        $auth->remove($auth->getPermission('rbacWebBulkAssignmentIndex'));
        $auth->remove($auth->getPermission('rbacWebBulkAssignmentAssign'));
        $auth->remove($auth->getPermission('rbacWebBulkAssignmentRevoke'));
        $auth->remove($auth->getPermission('rbacWebPermissionViewPath'));
        $auth->remove($auth->getPermission('rbacWebRoleViewPath'));

    }
}
