<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nutrition_items".
 *
 * @property integer $nutrition_items_id
 * @property string $icode
 * @property string $name
 * @property string $must_paid
 * @property string $use_right
 * @property double $unitprice
 * @property integer $nutrition_type
 * @property integer $calorie
 * @property string $hos_guid
 */
class NutritionItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nutrition_items';
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
            [['nutrition_items_id'], 'required'],
            [['nutrition_items_id', 'nutrition_type', 'calorie'], 'integer'],
            [['unitprice'], 'number'],
            [['icode'], 'string', 'max' => 7],
            [['name'], 'string', 'max' => 250],
            [['must_paid', 'use_right'], 'string', 'max' => 1],
            [['hos_guid'], 'string', 'max' => 38],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nutrition_items_id' => 'Nutrition Items ID',
            'icode' => 'Icode',
            'name' => 'Name',
            'must_paid' => 'Must Paid',
            'use_right' => 'Use Right',
            'unitprice' => 'Unitprice',
            'nutrition_type' => 'Nutrition Type',
            'calorie' => 'Calorie',
            'hos_guid' => 'Hos Guid',
        ];
    }
}
