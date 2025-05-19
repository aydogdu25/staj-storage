<?php

namespace portalium\theme\components;

use yii\base\Component;
use Yii;

class DeviceDetector extends Component
{
    public function detectDevice()
    {
        $userAgent = Yii::$app->request->getUserAgent();
        $mobileKeywords = ['Mobile', 'Android', 'iPhone', 'iPad', 'Windows Phone'];
        foreach ($mobileKeywords as $keyword) {
            if (stripos($userAgent, $keyword) !== false) {
                return 'mobile';
            }
        }
        return 'desktop';
    }

    public function getClass(){
        $device = $this->detectDevice();
        if($device == 'mobile'){
            return Yii::$app->setting->getValue('theme::menu_side_mobile');
        }
        return Yii::$app->setting->getValue('theme::menu_side_desktop');
    }
}
