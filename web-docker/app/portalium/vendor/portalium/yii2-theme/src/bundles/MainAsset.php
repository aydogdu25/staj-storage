<?php

namespace portalium\theme\bundles;

use yii\web\AssetBundle;

class MainAsset extends AssetBundle
{
    public $sourcePath = '@vendor/portalium/yii2-theme/src/assets/';

    public $css = [
        'apps/bootstrap/css/login.css',
    ];


    public function init()
    {
        parent::init();
    }
}
