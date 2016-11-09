<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "room_type".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Key[] $keys
 */
class RoomType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room_type';
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
    public function getKeys()
    {
        return $this->hasMany(Key::className(), ['room_type' => 'id']);
    }

    /**
     * @inheritdoc
     * @return RoomTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RoomTypeQuery(get_called_class());
    }
}
