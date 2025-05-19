<?php

namespace portalium\bootstrap5;

class Modal extends \yii\bootstrap5\Modal
{
    public function init()
    {
        $justifyClass = $this->closeButton ? 'justify-content-end' : 'justify-content-start';

        if (isset($this->headerOptions['class'])) {
            $this->headerOptions['class'] .= ' d-flex ' . $justifyClass;
        } else {
            $this->headerOptions['class'] = 'd-flex ' . $justifyClass;
        }

        parent::init();
    }
}