<?php

namespace portalium\theme\bundles;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $sourcePath = '@vendor/portalium/yii2-theme/src/assets/';

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
        'yii\bootstrap5\BootstrapPluginAsset',
        'portalium\theme\bundles\FontAwesomeAsset',
    ];

    public $css = [
        'apps/custom/css/site.css',
        'apps/custom/css/custom.css',
        'apps/bootstrap/css/dashboard.css',
        'apps/bootstrap/css/sidebar.css',
        'apps/bootstrap/css/panel.css',
    ];

    public $js = [
        'apps/custom/js/tab.js',
        'apps/custom/js/jquery.min.js'
    ];

    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];

    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];

    public function init()
    {
        parent::init();
    }
}
