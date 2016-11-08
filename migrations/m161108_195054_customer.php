<?php

use yii\db\Migration;

class m161108_195054_customer extends Migration
{
    public function safeUp()
    {
        $this->createTable('customer', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique(),
            'registration' => $this->string(50)->notNull()->unique(),
            'type' => $this->integer(2)->notNull()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('customer');
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
