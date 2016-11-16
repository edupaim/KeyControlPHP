<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "operation_history".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $customer_id
 * @property string $date
 * @property integer $key_id
 * @property integer $type
 *
 * @property Customer $customer
 * @property Key $key
 * @property OperationType $type0
 * @property User $user
 */
class OperationHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'operation_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'customer_id', 'date', 'key_id', 'type'], 'required'],
            [['user_id', 'customer_id', 'key_id', 'type'], 'integer'],
            [['date'], 'safe'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['key_id'], 'exist', 'skipOnError' => true, 'targetClass' => Key::className(), 'targetAttribute' => ['key_id' => 'id']],
            [['type'], 'exist', 'skipOnError' => true, 'targetClass' => OperationType::className(), 'targetAttribute' => ['type' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'date' => Yii::t('app', 'Date'),
            'key_id' => Yii::t('app', 'Key ID'),
            'type' => Yii::t('app', 'Type'),
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
    public function getKey()
    {
        return $this->hasOne(Key::className(), ['id' => 'key_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType0()
    {
        return $this->hasOne(OperationType::className(), ['id' => 'type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return OperationHistoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OperationHistoryQuery(get_called_class());
    }
}
