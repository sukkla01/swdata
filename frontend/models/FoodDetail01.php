<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "food_detail_01".
 *
 * @property integer $foodid
 * @property string $fooddate
 * @property string $foodtime
 * @property string $an
 * @property string $hn
 * @property string $meal
 * @property string $ward
 * @property string $icode
 * @property string $Congenital_disease
 * @property string $comment
 * @property string $fooddate_rec
 * @property string $staff
 * @property string $bd
 * @property string $cal
 */
class FoodDetail01 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'food_detail_01';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fooddate', 'foodtime', 'icode'], 'required'],
            [['fooddate', 'foodtime'], 'safe'],
            [['an', 'hn', 'meal', 'staff', 'cal'], 'string', 'max' => 50],
            [['ward'], 'string', 'max' => 3],
            [['icode'], 'string', 'max' => 7],
            [['Congenital_disease', 'comment'], 'string', 'max' => 100],
            [['fooddate_rec'], 'string', 'max' => 20],
            [['bd'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'foodid' => 'Foodid',
            'fooddate' => 'วันที่สั่งอาหาร',
            'foodtime' => 'เวลาสั่งอาหาร',
            'an' => 'An',
            'hn' => 'Hn',
            'meal' => 'Meal',
            'ward' => 'Ward',
            'icode' => 'รายการอาหาร',
            'Congenital_disease' => 'โรคประจำตัว',
            'comment' => 'หมายเหตุ',
            'fooddate_rec' => 'Fooddate Rec',
            'staff' => 'Staff',
            'bd' => 'สูตร',
            'cal' => 'ความเข้มข้น',
        ];
    }
}
