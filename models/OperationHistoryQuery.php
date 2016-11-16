<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OperationHistory]].
 *
 * @see OperationHistory
 */
class OperationHistoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return OperationHistory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return OperationHistory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
