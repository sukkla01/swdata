<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "food_process".
 *
 * @property string $is_running
 * @property string $ward
 */
class FoodProcess extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'food_process';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_running', 'ward'], 'required'],
            [['is_running'], 'string'],
            [['ward'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'is_running' => 'Is Running',
            'ward' => 'Ward',
        ];
    }
}
