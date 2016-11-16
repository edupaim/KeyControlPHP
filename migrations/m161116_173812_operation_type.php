<?php

use yii\db\Migration;

class m161116_173812_operation_type extends Migration
{
    public function safeUp()
    {
        $this->createTable('operation_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique()
        ]);

        $this->batchInsert('operation_type',
            ['id','name'],
            [['id'=>1, 'name'=>'Empréstimo'], ['id'=>2, 'name'=>'Devolução']]
        );

        $this->addForeignKey(
            'fk_operation_type',
            'operation_history',
            'type',
            'operation_type',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_operation_type', 'type');

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
