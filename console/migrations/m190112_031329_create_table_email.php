<?php

use yii\db\Schema;
use yii\db\Migration;

class m190112_031329_create_table_email extends Migration
{

    private $_tableName = 'email';
    private $_tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';

    public function safeUp()
    {/*{{{*/
        $this->createTable($this->_tableName, [
            'id'         => $this->primaryKey(),
            'subject'    => $this->string()->notNull(),
            'content'    => $this->text()->notNull(),
            'send_to'    => $this->text()->notNull(),
            'ip'         => $this->char(15)->notNull()->defaultValue(''),
            'status'     => $this->tinyInteger()->notNull()->defaultValue(0),
            'send_at'    => $this->integer()->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->string()->notNull(),
        ], $this->_tableOptions);

        $this->createIndex('idx_created_at', $this->_tableName, 'created_at');
        $this->createIndex('idx_send_at', $this->_tableName, 'send_at');
    }/*}}}*/

    public function safeDown()
    {/*{{{*/
        $this->dropTable($this->_tableName);
    }/*}}}*/

}