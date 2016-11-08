<?php

use yii\db\Migration;

class m161108_191929_user_type extends Migration
{
    public function safeUp()
    {
        $this->createTable('user_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique()
        ]);

        $this->batchInsert('user_type',
            ['id','name'],
            [['id'=>1, 'name'=>'Administrador'], ['id'=>2, 'name'=>'Funcionário']]
         );

        $this->addForeignKey(
            'fk_user_type',
            'user',
            'type',
            'user_type',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_user_type',
            'user_type'
        );

        $this->dropTable('user_type');
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
