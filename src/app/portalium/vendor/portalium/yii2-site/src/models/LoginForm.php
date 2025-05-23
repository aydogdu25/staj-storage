<?php

namespace portalium\site\models;

use Yii;
use portalium\base\Event;
use yii\base\Model;
use portalium\site\Module;
use yii\validators\EmailValidator;
use portalium\user\models\User;


class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    private $_user;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => Module::t('Email / Username'),
            'password' => Module::t('Password'),
            'rememberMe' => Module::t('Remember Me'),
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Module::t('Incorrect email or password.'));
            }
        }
    }

    public function login()
    {
        //The user's login credentials are being verified.
        if ($this->validate()) {
            //The user's information is being collected.
            $user = $this->getUser();

            if (Yii::$app->setting->getValue('site::verifyEmail')) {
                if ($user->status === User::STATUS_ACTIVE) {
                    Yii::$app->session->set("login_status", true);
                    Event::trigger(Yii::$app->getModules(), Module::EVENT_ON_LOGIN, new Event(['payload' => $user]));
                    \Yii::$app->trigger(Module::EVENT_ON_LOGIN, new Event(['payload' => $user]));
                    return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
                } else {    
                    Yii::$app->session->set("login_status", false);
                    if (!$user->verification_token){
                        $user->generateEmailVerificationToken();
                        $user->save(false) ? $user : null;
                    }
                    $verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/auth/verify-email', 'token' => $user->verification_token]);
                    $emailVerificationLink = Yii::$app->urlManager->createAbsoluteUrl(['/site/auth/resend-verification-email']);
                    // Yii::$app->session->addFlash('error', 'Your account is not active. Please activate your account.<a href="' . $emailVerificationLink . '"> '/*.$verifyLink*/ . "Click here!" . '</a>');
                    Yii::$app->session->addFlash('error', 'Your account is not active. Please activate your account.');
                    // send email
                    Yii::$app->site->mailer->setViewPath(Yii::getAlias('@portalium/site/mail'));
                    Yii::$app
                        ->site
                        ->mailer
                        ->compose(
                            ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                            ['user' => $user]
                        )
                        ->setFrom(Yii::$app->setting->getValue('email::address'))
                        ->setTo($user->email)
                        ->setSubject(Module::t('Account activation for {email_displayname}!', ['email_displayname' => Yii::$app->setting->getValue('email::displayname')]))
                        ->send();
                    return false;
                }
            } else {
                //If "User Status" is selected as "Active" in SMTP.
                if (Yii::$app->setting->getValue('site::userStatus') == User::STATUS_ACTIVE) {
                    $user->status = User::STATUS_ACTIVE;
                    $user->save(false) ? $user : null;
                } else if (Yii::$app->setting->getValue('site::userStatus') == User::STATUS_PASSIVE) {
                    $user->status = User::STATUS_PASSIVE;
                    $user->save(false) ? $user : null;
                }
                //If the user status is active.
                if ($user->status === User::STATUS_ACTIVE) {
                    Yii::$app->session->set("login_status", true);
                    Event::trigger(Yii::$app->getModules(), Module::EVENT_ON_LOGIN, new Event(['payload' => $user]));
                    Yii::$app->trigger(Module::EVENT_ON_LOGIN, new Event(['payload' => $user]));
                    return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
                } else {
                    Yii::$app->session->set("login_status", false);
                    $verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/auth/verify-email', 'token' => $user->verification_token]);
                    $emailVerificationLink = Yii::$app->urlManager->createAbsoluteUrl(['/site/auth/resend-verification-email']);
                    Yii::$app->session->addFlash('error', 'Your account is not active. Please activate your account.<a href="' . $emailVerificationLink . '"> '/*.$verifyLink*/ . "Click here!" . '</a>');
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findOne(
                (new EmailValidator())->validate($this->username) ?
                    ['email' => $this->username] : ['username' => $this->username]
            );
        }

        return $this->_user;
    }
}
