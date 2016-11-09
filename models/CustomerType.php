<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer_type".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Customer[] $customers
 */
class CustomerType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['type' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CustomerTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerTypeQuery(get_called_class());
    }
}
