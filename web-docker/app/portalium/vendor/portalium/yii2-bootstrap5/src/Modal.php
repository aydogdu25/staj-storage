<?php

namespace portalium\bootstrap5;

class Modal extends \yii\bootstrap5\Modal
{
    
    public function init()
    {
        $this->headerOptions = ['class' => 'd-flex justify-content-end'];
        parent::init();
    }
}
