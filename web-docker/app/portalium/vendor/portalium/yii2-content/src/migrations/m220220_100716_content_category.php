<?php

use yii\db\Migration;
use portalium\content\Module;
use portalium\user\Module as UserModule;

class m220220_100716_content_category extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%' . Module::$tablePrefix . 'category}}',
            [
                'id_category'=> $this->primaryKey(),
                'name'=> $this->string(255)->notNull(),
                'slug'=> $this->string(255)->notNull(),
                'id_user'=> $this->integer(11)->notNull(),
                'layout'=> $this->string(255),
                'date_create'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
                'date_update'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            ],$tableOptions
        );

        // creates index for column `id_user`
        $this->createIndex(
            '{{%idx-' . Module::$tablePrefix . 'category-id_user}}',
            '{{%' . Module::$tablePrefix . 'category}}',
            'id_user'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-' . Module::$tablePrefix . 'category-id_user}}',
            '{{%' . Module::$tablePrefix . 'category}}',
            'id_user',
            '{{%' . UserModule::$tablePrefix . 'user}}',
            'id_user',
            'RESTRICT'
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%' . Module::$tablePrefix . 'category}}');
    }
}
