<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CustomerType]].
 *
 * @see CustomerType
 */
class CustomerTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CustomerType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CustomerType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
