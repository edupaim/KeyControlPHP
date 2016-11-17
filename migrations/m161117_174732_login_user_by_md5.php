<?php

use yii\db\Migration;

class m161117_174732_login_user_by_md5 extends Migration
{
    public function safeUp()
    {
        $this->addColumn('user', 'createdDate', $this->dateTime()->notNull());
    }

    public function safeDown()
    {
        $this->dropColumn('user', 'createdDate');
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
