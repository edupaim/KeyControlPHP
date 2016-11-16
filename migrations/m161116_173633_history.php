<?php

use yii\db\Migration;

class m161116_173633_history extends Migration
{
    public function safeUp()
    {
        $this->createTable('operation_history',[
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'customer_id' => $this->integer()->notNull(),
            'date' => $this->date()->notNull(),
            'key_id' => $this->integer()->notNull(),
            'type' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('fk_customer_id_history',
            'operation_history',
            'customer_id',
            'customer',
            'id',
            'CASCADE');

        $this->addForeignKey('fk_user_id_history',
            'operation_history',
            'user_id',
            'user',
            'id',
            'CASCADE');

        $this->addForeignKey('fk_key_id_history',
            'operation_history',
            'key_id',
            'key',
            'id',
            'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_customer_id', 'customer_id');
        $this->dropForeignKey('fk_user_id', 'user_id');
        $this->dropForeignKey('fk_key_id', 'key_id');

        $this->dropTable('operation_history');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
