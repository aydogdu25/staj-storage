<?php

namespace portalium\site\components;

use Yii;
use portalium\components\Mailer as CoreMailer;
use Symfony\Component\Mailer\Transport\Smtp\SmtpTransport;

class Mailer extends CoreMailer
{
    public function init()
    {
        parent::init();
        $transport = [
            'class' => SmtpTransport::class,
            'host' => Yii::$app->setting->getValue('smtp::server'),
            'username' => Yii::$app->setting->getValue('smtp::username'),
            'password' => Yii::$app->setting->getValue('smtp::password'),
            'port' => Yii::$app->setting->getValue('smtp::port'),
            'encryption' => Yii::$app->setting->getValue('smtp::encryption'),
            'scheme' => 'smtp'
        ];

        $this->setTransport($transport);
    }
}
