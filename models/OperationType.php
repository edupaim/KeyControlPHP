<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "operation_type".
 *
 * @property integer $id
 * @property string $name
 *
 * @property OperationHistory[] $operationHistories
 */
class OperationType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'operation_type';
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
    public function getOperationHistories()
    {
        return $this->hasMany(OperationHistory::className(), ['type' => 'id']);
    }

    /**
     * @inheritdoc
     * @return OperationTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OperationTypeQuery(get_called_class());
    }
}
