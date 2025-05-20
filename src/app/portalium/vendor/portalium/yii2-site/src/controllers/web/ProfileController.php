<?php

namespace portalium\site\controllers\web;

use portalium\site\models\ProfileForm;
use portalium\site\models\ProfilePasswordForm;
use portalium\user\models\User;
use portalium\web\Controller as WebController;
use portalium\site\Module;
use Yii;

class ProfileController extends WebController
{
    public function actionEdit()
    {

        if (!Yii::$app->user->can('siteWebProfileEdit')) {
            throw new \yii\web\ForbiddenHttpException(Module::t('You are not allowed to access this page.'));
        }

        $modelProfile = new ProfileForm();
        $modelPassword = new ProfilePasswordForm();

        $user = User::findOne(Yii::$app->user->identity->id_user);
        $modelProfile->username = $user->username;
        $modelProfile->first_name = $user->first_name;
        $modelProfile->last_name = $user->last_name;
        $modelProfile->email = $user->email;
        $modelProfile->id_avatar=$user->id_avatar;



        if ($modelProfile->load(Yii::$app->request->post())) {
            if ($modelProfile->updateUser()) {
                Yii::$app->session->addFlash('success', Module::t('Your profile has been successfully updated!'));
            }
        }
        return $this->render('edit', [
            'modelProfile' => $modelProfile,
            'modelPassword' => $modelPassword,

        ]);
    }

    public function actionEditPassword()
    {

        if (!Yii::$app->user->can('siteWebProfileEditPassword')) {
            throw new \yii\web\ForbiddenHttpException(Module::t('You are not allowed to access this page.'));
        }

        $modelPassword = new  ProfilePasswordForm();
        $modelProfile = new ProfileForm();

        $user = User::findOne(Yii::$app->user->identity->id_user);
        $modelProfile->username = $user->username;
        $modelProfile->first_name = $user->first_name;
        $modelProfile->last_name = $user->last_name;
        $modelProfile->email = $user->email;
        $modelProfile->id_avatar=$user->id_avatar;


        if ($modelPassword->load(Yii::$app->request->post())) {
            if ($modelPassword->updatePassword()) {
                Yii::$app->session->addFlash('success', Module::t('Your password has been successfully updated'));
                $modelPassword = new ProfilePasswordForm();
            } else {
                Yii::$app->session->addFlash('error', Module::t('Your old Password information is incorrect!'));
                $modelPassword = new ProfilePasswordForm();
            }
        }

        return $this->render('edit', [
            'modelPassword' => $modelPassword,
            'modelProfile' => $modelProfile,
        ]);
    }
}
