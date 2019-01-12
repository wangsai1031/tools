<?php

use yii\db\Schema;
use yii\db\Migration;

class m190112_031329_create_table_email extends Migration
{

    public $tableName = 'email';
    public $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';

    public function safeUp()
    {/*{{{*/
        $this->createTable($this->tableName, [
            'id'         => $this->primaryKey(),

            'subject'    => $this->string()->notNull(),
            'content'    => $this->text()->notNull(),
            'send_to'    => $this->text()->notNull(),

            'status'     => 'tinyint unsigned not null default 0',

            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->string()->notNull(),

        ], $this->tableOptions);
    }/*}}}*/

    public function safeDown()
    {/*{{{*/
        $this->dropTable($this->tableName);
    }/*}}}*/

}
