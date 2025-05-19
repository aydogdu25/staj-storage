<?php

namespace portalium\site\components;

use portalium\site\models\Preference;
use yii\base\Component;
use portalium\site\Module;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\base\InvalidConfigException;
use portalium\site\models\Setting as Settings;

class Setting extends Component
{
    public function getConfig($name)
    {
        return self::decode(self::findSetting($name)->config);
    }

    public function setConfig($name, $value)
    {
        $setting = self::findSetting($name);
        $setting->config = $value;
        return $setting->save();
    }

    public function getAll()
    {
        return ArrayHelper::map(Settings::find()->asArray()->all(),'name','value');
    }

    public function getValue($name)
    {
        if(isset(\Yii::$app->user->id))
        {
            $settingModel=self::findSetting($name);
            $preferenceModel=self::findPreference($settingModel->id);
//            if (\Yii::$app->session->get($name) !== null) {
//                return self::decode(Yii::$app->session->get($name));
//            }
            if($preferenceModel)
            {
                return self::decode(self::findPreference($settingModel->id)->value);
            }
            else
            {
                return self::decode(self::findSetting($name)->value);
            }

        }
        return self::decode(self::findSetting($name)->value);

    }

    public static function getSetting($name)
    {
        $settingModel=self::findSetting($name);
        $preferenceModel=self::findPreference($settingModel->id);

        if($preferenceModel)
        {
            return self::findPreference($settingModel->id);;
        }
        else
        {
            return self::findSetting($name);
        }
    }

    private function decode($value)
    {
        return ($this->isJson($value,true)) ? json_decode($value, true): $value;
    }

    private static function findSetting($name)
    {
        if (($setting = Settings::findOne(['name' => $name])) !== null) {
            return $setting;
        }

        throw new NotFoundHttpException(Module::t('The requested '.$name.' setting does not exist.'));
    }

    private static function findPreference($id)
    {
        $id_user=\Yii::$app->user->id;
        $id_workspace=\Yii::$app->workspace->id;

        if (($preference = Preference::findOne(['id_setting' => $id,'id_user'=>$id_user,'id_workspace'=>$id_workspace])) !== null) {
            return $preference;
        }

       return false;
    }

    function isJson($value) {
        $value = strval($value);
        json_decode($value);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
