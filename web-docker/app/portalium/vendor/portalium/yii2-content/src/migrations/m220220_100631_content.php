<?php

use yii\db\Migration;
use portalium\content\Module;
use portalium\user\Module as UserModule;

class m220220_100631_content extends Migration
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
            '{{%' . Module::$tablePrefix . 'content}}',
            [
                'id_content'=> $this->primaryKey(),
                'name'=> $this->string(255)->notNull(),
                'title'=> $this->text()->notNull(),
                'body'=> $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext')->null()->defaultValue(null),
                'id_user'=> $this->integer(11)->notNull(),
                'id_category'=> $this->integer(11)->notNull(),
                'status'=> $this->smallInteger(6)->notNull(),
                'date_create'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
                'date_update'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            ],$tableOptions
        );
        // creates index for column `id_user`
        $this->createIndex(
            '{{%idx-' . Module::$tablePrefix . 'content-id_user}}',
            '{{%' . Module::$tablePrefix . 'content}}',
            'id_user'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-' . Module::$tablePrefix . 'content-id_user}}',
            '{{%' . Module::$tablePrefix . 'content}}',
            'id_user',
            '{{%' . UserModule::$tablePrefix . 'user}}',
            'id_user',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%' . Module::$tablePrefix . 'content}}');
    }
}
