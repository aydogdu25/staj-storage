<?php

namespace portalium\theme;

class Module extends \portalium\base\Module
{
    public static $name = 'Theme';
    
    public static function moduleInit()
    {
        self::registerTranslation('theme','@portalium/theme/messages',[
            'theme/theme' => 'theme.php',
        ]);
    }

    public function registerComponents()
    {
        return [
            'theme' => [
                'class' => 'portalium\theme\Theme',
            ],
            'deviceDetector' => [
                'class' => 'portalium\theme\components\DeviceDetector',
            ],
            'icon' => [
                'class' => 'portalium\theme\components\Icon',
            ],
        ];
    }

    public static function getLayouts()
    {
        return [
            [
                'layout' => 'main',
                'name' => self::t('Main'),
            ],
            [
                'layout' => 'dashboard',
                'name' => self::t('Dashboard'),
            ],
            [
                'layout' => 'login',
                'name' => self::t('Login'),
            ],
        ];
    }

    public static function t($message, array $params = [])
    {
        return parent::coreT('theme', $message, $params);
    }
}
