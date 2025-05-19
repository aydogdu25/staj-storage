<?php

namespace portalium\rbac;

class Module extends \portalium\base\Module

{
    const EVENT_ITEM_DELETE = 'afterDelete';
    const EVENT_ITEM_UPDATE = 'afterUpdate';

    public static $description = 'RBAC Management Module';
    public static $name = 'RBAC';

    public $apiRules = [
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
                'rbac/default',
            ],
        ],
    ];

    public static $tablePrefix = 'rbac_';

    public function getMenuItems()
    {
        $menuItems = [
            [
                [
                    'menu' => 'web',
                    'type' => 'action',
                    'route' => '/rbac/role',
                ],
                [
                    'menu' => 'web',
                    'type' => 'action',
                    'route' => '/rbac/permission',
                ],
            ],
        ];
        return $menuItems;
    }

    public static function moduleInit()
    {
        self::registerTranslation('rbac', '@portalium/rbac/messages', [
            'rbac' => 'rbac.php',
        ]);
    }

    public static function t($message, array $params = [])
    {
        return parent::coreT('rbac', $message, $params);
    }

}
