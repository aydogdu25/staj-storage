<?php
namespace portalium\theme\widgets;

class ActiveForm extends \portalium\bootstrap5\ActiveForm
{
    public function init()
    {
        $this->layout = 'horizontal';
        parent::init();
    }
}