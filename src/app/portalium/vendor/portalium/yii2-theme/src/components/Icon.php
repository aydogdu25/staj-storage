<?php

namespace portalium\theme\components;

use portalium\theme\bundles\IconAsset;
use yii\base\Component;
use Yii;

class Icon extends Component
{
    public function get($name)
    {
        return '<img src="' . Yii::$app->view->getAssetManager()->getBundle(IconAsset::class)->baseUrl . '/' . $name . '.svg" alt="' . $name . '">';
    }
}
