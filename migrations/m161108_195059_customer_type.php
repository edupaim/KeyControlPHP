<?php

use yii\db\Migration;

class m161108_195059_customer_type extends Migration
{
    public function up()
    {
        $this->createTable('customer_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique()
        ]);

        $this->batchInsert('customer_type',
            ['id','name'],
            [['id'=>1, 'name'=>'Aluno'], ['id'=>2, 'name'=>'Professor']]
        );

        $this->addForeignKey(
            'fk_customer_type',
            'customer',
            'type',
            'customer_type',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk_customer_type',
            'customer_type'
        );

        $this->dropTable('customer_type');
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
