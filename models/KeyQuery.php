<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Key]].
 *
 * @see Key
 */
class KeyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Key[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Key|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function alreadyBorrowed()
    {
        return $this->andWhere('[[customer_id]] IS NOT NULL');
    }
}
