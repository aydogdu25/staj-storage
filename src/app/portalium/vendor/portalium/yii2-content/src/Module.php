<?php

namespace portalium\content;

use portalium\base\Event;
use portalium\site\widgets\LoginButton;
use portalium\user\Module as UserModule;
use portalium\content\components\TriggerActions;

class Module extends \portalium\base\Module
{
    public static $description = 'Content Management Module';
    public static $tablePrefix = 'content_';
    public static $name = 'Content';
    public $apiRules = [
        [
            'class' => 'yii\rest\UrlRule',
            'controller' => [
                'content/default',
                'content/category',
            ],
            'pluralize' => false
        ],
    ];

    public function getMenuItems()
    {
        $menuItems = [
            [
                [
                    'menu' => 'web',
                    'type' => 'model',
                    'class' => 'portalium\content\models\Content',
                    'route' => '/content/default/show',
                    'field' => ['id' => 'id_content', 'name' => 'title'],
                ],
                [
                    'menu' => 'web',
                    'type' => 'action',
                    'route' => '/content/default/index',
                ],
                [
                    'menu' => 'web',
                    'type' => 'action',
                    'route' => '/content/category/index',
                ],
            ],
        ];
        return $menuItems;
    }

    public static function moduleInit()
    {
        self::registerTranslation('content', '@portalium/content/messages', [
            'content' => 'content.php',
        ]);
    }

    public static function t($message, array $params = [])
    {
        return parent::coreT('content', $message, $params);
    }

    public function registerEvents()
    {
        Event::on($this::className(), UserModule::EVENT_USER_DELETE_BEFORE, [new TriggerActions(), 'onUserDeleteBefore']);
    }
}
