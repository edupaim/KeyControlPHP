<?php

use yii\db\Migration;

class m161116_184824_alter_column_date_history extends Migration
{
    public function safeUp()
    {
        $this->alterColumn(
            'operation_history',
            'date',
            $this->dateTime()->notNull()
        );
    }

    public function down()
    {
        $this->alterColumn(
            'operation_history',
            'date',
            $this->date()->notNull()
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
