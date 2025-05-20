<?php

use yii\db\Migration;
use portalium\content\Module;

class m230404_100631_content extends Migration
{

    public function safeUp()
    {
        $this->addColumn('{{%' . Module::$tablePrefix . 'content}}', 'layout', $this->string(255));
        $this->addColumn('{{%' . Module::$tablePrefix . 'content}}', 'access', $this->smallInteger(6));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%' . Module::$tablePrefix . 'content}}', 'layout');
        $this->dropColumn('{{%' . Module::$tablePrefix . 'content}}', 'access');
    }
}
