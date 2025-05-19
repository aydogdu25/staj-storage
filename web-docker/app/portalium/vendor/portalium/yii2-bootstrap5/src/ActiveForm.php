<?php

namespace portalium\bootstrap5;

class ActiveForm extends \yii\bootstrap5\ActiveForm
{
    public static function generateActiveFormWithJson($json)
    {
        $json = json_decode($json, true);
        
        $form = ActiveForm::begin($json);

        return $form;
        
    }
}
