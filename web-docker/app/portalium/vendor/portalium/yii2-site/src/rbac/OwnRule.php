<?php
namespace portalium\site\rbac;


use yii\rbac\Rule;

class OwnRule extends Rule
{
    public $name = 'siteOwnRule';
    public function execute($user, $item, $params)
    {
        return isset($params['model']) ? $params['model']->id_user == $user : false;
    }
}