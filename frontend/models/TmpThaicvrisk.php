<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tmp_thaicvrisk".
 *
 * @property integer $id
 * @property string $vstdate
 * @property string $hn
 * @property string $vn
 * @property string $tname
 * @property integer $age
 * @property string $bp
 * @property string $tc
 * @property string $sex
 * @property string $is_dm
 * @property string $smoker
 * @property string $waist
 * @property double $height
 * @property string $tcolor
 */
class TmpThaicvrisk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tmp_thaicvrisk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'vn'], 'required'],
            [['id', 'age'], 'integer'],
            [['height'], 'number'],
            [['vstdate'], 'string', 'max' => 50],
            [['hn', 'bp', 'tc'], 'string', 'max' => 10],
            [['vn'], 'string', 'max' => 20],
            [['tname'], 'string', 'max' => 255],
            [['sex', 'is_dm', 'smoker', 'tcolor'], 'string', 'max' => 1],
            [['waist'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vstdate' => 'วันที่มารับ',
            'hn' => 'HN',
            'vn' => 'VN',
            'tname' => 'ชื่อ-สกุล',
            'age' => 'อายุ',
            'bp' => 'BP',
            'tc' => 'Tc',
            'sex' => 'เพศ',
            'is_dm' => 'เป็นเบาหวาน',
            'smoker' => 'สูบบุหรี่',
            'waist' => 'รอบเอว',
            'height' => 'สูง',
            'tcolor' => 'color',
        ];
    }
}
