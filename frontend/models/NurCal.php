<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nur_cal".
 *
 * @property integer $id
 * @property string $name
 * @property string $detail
 */
class NurCal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nur_cal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'detail'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'detail' => 'Detail',
        ];
    }
}
