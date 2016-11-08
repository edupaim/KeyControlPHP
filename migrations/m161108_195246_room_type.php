<?php

use yii\db\Migration;

class m161108_195246_room_type extends Migration
{
    public function up()
    {
        $this->createTable('room_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique()
        ]);

        $this->batchInsert('room_type',
            ['id', 'name'],
            [['id' => 1, 'name' => 'Sala'],
                ['id' => 2, 'name' => 'Reunião'],
                ['id' => 3, 'name' => 'Laboratório']]
        );

        $this->addForeignKey(
            'fk_room_type',
            'key',
            'room_type',
            'room_type',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk_room_type',
            'room_type'
        );

        $this->dropTable('room_type');
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
