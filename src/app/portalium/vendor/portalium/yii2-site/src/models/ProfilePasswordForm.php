<?php

namespace portalium\site\models;

use yii\base\Model;
use portalium\site\Module;
use Yii;
use portalium\user\models\User;


class ProfilePasswordForm extends Model
{
    public $password;
    public $old_password;

    public function rules()
    {
        $rules = [
            [['password'], 'required'],
            [['old_password'], 'required'],
            ['old_password', 'string', 'min' => 6],
            ['password', 'string', 'min' => 6],
        ];
        return $rules;
    }


    public function attributeLabels()
    {
        return [
            'old_password' => Module::t('Current Password'),
            'password' => Module::t('New Password'),
        ];
    }


    public function updatePassword()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = User::findOne(Yii::$app->user->identity->id_user);

        if ($user) {
            if ($user->validatePassword($this->old_password)) {
                $user->setPassword($this->password);
                return $user->save();
            } else {
                return false;
            }
        }
    }
}
