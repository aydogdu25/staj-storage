<?php

namespace portalium\theme\widgets;

use Yii;

class GridView extends \portalium\grid\GridView
{

    public function init()
    {
        parent::init();
        $this->layout = "{items}<div class='panel-footer d-flex justify-content-between'>" . str_replace('{items}', '', $this->layout) . '</div>';
        if (strpos($this->layout, '{pagesizer}{pager}') !== false) {
            $this->layout = str_replace('{pagesizer}{pager}', '<div class="d-flex">{pagesizer}{pager}</div>', $this->layout);
        } else {
            $this->layout = str_replace('{pager}', '<div class="d-flex">{pager}</div>', $this->layout);
        }
    }
}
