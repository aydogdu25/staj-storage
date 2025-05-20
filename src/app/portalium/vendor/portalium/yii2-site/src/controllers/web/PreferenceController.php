<?php

namespace portalium\site\controllers\web;

use Yii;
use portalium\site\Module;
use yii\helpers\ArrayHelper;
use portalium\site\models\Setting;
use portalium\web\Controller as WebController;

use portalium\site\models\Preference;
use portalium\site\models\PreferenceSearch;
use portalium\site\models\SettingValue;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * PreferenceController implements the CRUD actions for Preference model.
 */
class PreferenceController extends WebController
{
    public function actionIndex()
    {
        if(!Yii::$app->user->can('siteWebPreferenceIndex')){
            throw new \yii\web\ForbiddenHttpException(Module::t('You are not allowed to access this page.'));
        }

        $settings = Setting::find()
            ->where(['is_preference' => 1])
            ->orderBy(['module' => SORT_ASC,'id' => SORT_ASC,'name'=>SORT_ASC])
            ->indexBy('id')
            ->all();
        $settingsGroup = ArrayHelper::index($settings, null, 'module');

        foreach ($settings as $setting) {

            $preference = Preference::find()
                ->where([
                    'id_user' =>\Yii::$app->user->id,
                    'id_workspace' =>\Yii::$app->workspace->id,
                    'id_setting' => $setting->id,
                ])
                ->one();

            if($preference)
            {
                $setting->value=$preference->value;
            }

            $setting->value = ($this->isJson($setting->value) && in_array($setting->type, SettingValue::getScenarios()['multiple'])) ? json_decode($setting->value) : $setting->value;
        }

        return $this->render('index', [
            'settings' => $settings,
            'settingsGroup' => $settingsGroup
        ]);
    }

    /**
     * Updates an existing Preference model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_preference Id Preference
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        if(!Yii::$app->user->can('siteWebPreferenceUpdate')){
            throw new \yii\web\ForbiddenHttpException(Module::t('You are not allowed to access this page.'));
        }
        $settings = Setting::find()->indexBy('id')->all();
        $preferenceData = Yii::$app->request->post('Setting');

        foreach ($settings as $setting)
        {
            $valueModel = new SettingValue();
            if(!isset($preferenceData["$setting->module-$setting->id"])){
                continue;
            }else{

            }

            //setting is updating
            $valueModel->value = $preferenceData["$setting->module-$setting->id"]['value'];
            $valueModel->scenario = $setting->type;

            if ($valueModel->validate()) {
                $preferenceData["$setting->module-$setting->id"]['value'] = (is_array($valueModel->value)) ? json_encode($valueModel->value) : $valueModel->value;
            }else{
                Yii::$app->session->addFlash('error', Module::t('There are an error. Settings not saved.'));
                return $this->redirect('index');
            }

            if ($setting->validate()) {

                $preferenceModel=new Preference();

                $preferenceModel->value=$preferenceData["$setting->module-$setting->id"]['value'];
                $preferenceModel->id_user=Yii::$app->user->id;
                $preferenceModel->id_workspace=Yii::$app->workspace->id;
                $preferenceModel->id_setting=$setting->id;

                $preference = Preference::find()
                    ->where([
                        'id_user' => $preferenceModel->id_user,
                        'id_workspace' => $preferenceModel->id_workspace,
                        'id_setting' => $preferenceModel->id_setting,
                    ])
                    ->one();

                if($setting->value != $preferenceModel->value)
                {
                    if($preference==null)
                    {
                        $preferenceModel->save();
                    }

                    elseif ($preference->value != $preferenceModel->value) {
                        $preference->value=$preferenceModel->value;
                        $preference->save();
                    }
                }
                elseif ($preference!=null && $setting->value == $preferenceModel->value)
                {
                    $preference->delete();
                }

            }else{
                Yii::$app->session->addFlash('error', Module::t('There are an error. Settings not saved.'));
                return $this->redirect('index');
            }
        }

        Yii::$app->session->addFlash('success', Module::t('Settings saved'));

        return $this->redirect('index');
    }

    public function isJson($string) {
        if(!$string) {
            return false;
        }
        return json_last_error() === JSON_ERROR_NONE;
    }


}
