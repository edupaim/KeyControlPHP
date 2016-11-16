<?php

use yii\db\Migration;

class m161108_195231_key extends Migration
{
    public function safeUp()
    {
        $this->createTable('key', [
            'id' => $this->primaryKey(),
            'room' => $this->string(50)->notNull()->unique(),
            'capacity' => $this->string(50)->notNull()->unique(),
            'room_type' => $this->integer(2)->notNull(),
            'customer_id' => $this->integer(11)->null()
        ]);

        $this->addForeignKey(
            'fk_customer_id',
            'key',
            'customer_id',
            'customer',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_customer_id',
            'customer_id'
        );

        $this->dropTable('key');
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
