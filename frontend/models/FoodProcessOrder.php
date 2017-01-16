<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "food_process_order".
 *
 * @property string $p_current
 * @property string $ward
 * @property string $d_last
 */
class FoodProcessOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'food_process_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p_current', 'ward'], 'required'],
            [['d_last'], 'safe'],
            [['p_current'], 'string', 'max' => 10],
            [['d_last'], 'date'],
            [['ward'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'p_current' => 'P Current',
            'ward' => 'Ward',
            'd_last' => 'D Last',
        ];
    }
}
