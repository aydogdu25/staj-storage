<?php

namespace portalium\theme\bundles;

use yii\web\AssetBundle;

class IconAsset extends AssetBundle
{
    public $sourcePath = '@vendor/portalium/yii2-theme/src/assets/icons/';
    
    public $depends = [
        'portalium\theme\bundles\AppAsset'
    ];

    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];

    public function init()
    {
        parent::init();
    }
}
