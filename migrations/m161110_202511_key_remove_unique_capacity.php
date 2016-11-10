<?php

use yii\db\Migration;

class m161110_202511_key_remove_unique_capacity extends Migration
{
    public function safeUp()
    {
        $this->dropIndex(
            'capacity',
            'key'
        );

        $this->alterColumn(
            'key',
            'capacity',
            $this->integer()->notNull()
        );
    }

    public function safeDown()
    {
        $this->alterColumn(
            'key',
            'capacity',
            $this->string(50)->notNull()->unique()
        );
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
