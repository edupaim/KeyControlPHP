<?php

use yii\db\Migration;

class m161108_190617_user extends Migration
{
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique(),
            'user' => $this->string(50)->notNull()->unique(),
            'password' => $this->string(50)->notNull()->unique(),
            'type' => $this->integer(2)->notNull()
        ]);


    }

    public function safeDown()
    {
        $this->dropTable('user');
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
