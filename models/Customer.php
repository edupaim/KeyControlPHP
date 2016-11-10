<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id
 * @property string $name
 * @property string $registration
 * @property integer $type
 *
 * @property CustomerType $type0
 * @property Key[] $keys
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'registration', 'type'], 'required'],
            [['type'], 'integer'],
            [['name', 'registration'], 'string', 'max' => 50],
            [['name'], 'unique'],
            [['registration'], 'unique'],
            [['type'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerType::className(), 'targetAttribute' => ['type' => 'id']],
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
            'registration' => Yii::t('app', 'Registration'),
            'type' => Yii::t('app', 'Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType0()
    {
        return $this->hasOne(CustomerType::className(), ['id' => 'type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKeys()
    {
        return $this->hasMany(Key::className(), ['customer_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CustomerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerQuery(get_called_class());
    }

    public function getAllAttributes()
    {
        return "$this->name - $this->registration";
    }
}
