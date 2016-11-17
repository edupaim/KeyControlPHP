<?php

use yii\db\Migration;

class m161117_175452_generate_md5 extends Migration
{
    public function up()
    {

        $this->update('user',['password' => new \yii\db\Expression('MD5(CONCAT(password, createdDate))')]);
        /*$userData = \app\models\User::find()->all();
        foreach ($userData as $user) {
            $user->password = \app\models\User::generateMd5($user->password, $user->createdDate);
            $user->save();
        }*/
    }

    public function down()
    {
        echo "m161117_175452_generate_md5 cannot be reverted.\n";

        return false;
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
