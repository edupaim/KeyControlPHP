<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "key".
 *
 * @property integer $id
 * @property string $room
 * @property integer $capacity
 * @property integer $room_type
 * @property integer $customer_id
 *
 * @property Customer $customer
 * @property RoomType $roomType
 */
class Key extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'key';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['room', 'capacity', 'room_type'], 'required'],
            [['room_type', 'customer_id', 'capacity'], 'integer'],
            [['room'], 'string', 'max' => 50],
            [['room'], 'unique'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['room_type'], 'exist', 'skipOnError' => true, 'targetClass' => RoomType::className(), 'targetAttribute' => ['room_type' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'room' => Yii::t('app', 'Room'),
            'capacity' => Yii::t('app', 'Capacity'),
            'room_type' => Yii::t('app', 'Room Type'),
            'customer_id' => Yii::t('app', 'Customer ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomType()
    {
        return $this->hasOne(RoomType::className(), ['id' => 'room_type']);
    }

    /**
     * @inheritdoc
     * @return KeyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new KeyQuery(get_called_class());
    }

    public function getAllAttributes()
    {
        return "$this->room - $this->capacity - {$this->roomType->name}";
    }
}
