<?php

namespace app\modules\bmd\models;

use Yii;

/**
 * This is the model class for table "bonemass".
 *
 * @property integer $id
 * @property string $hn
 * @property string $vstdate
 * @property string $vn
 * @property string $l1l4
 * @property string $neck_lt
 * @property string $neck_rt
 * @property string $troch_lt
 * @property string $troch_rt
 * @property string $create_date
 */
class Bonemass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bonemass';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vstdate', 'create_date'], 'safe'],
            [['hn', 'vn', 'l1l4', 'neck_lt', 'neck_rt', 'troch_lt', 'troch_rt'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hn' => 'Hn',
            'vstdate' => 'Vstdate',
            'vn' => 'Vn',
            'l1l4' => 'L1-L4',
            'neck_lt' => 'Neck Lt',
            'neck_rt' => 'Neck Rt',
            'troch_lt' => 'Troch Lt',
            'troch_rt' => 'Troch Rt',
            'create_date' => 'Create Date',
        ];
    }
}
