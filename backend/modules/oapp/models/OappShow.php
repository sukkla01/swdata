<?php

namespace app\modules\oapp\models;

use Yii;

/**
 * This is the model class for table "oapp_show".
 *
 * @property string $vstdate
 * @property string $tcount
 * @property string $color
 */
class OappShow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oapp_show';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db5');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vstdate'], 'required'],
            [['vstdate', 'tcount', 'color'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'vstdate' => 'Vstdate',
            'tcount' => 'Tcount',
            'color' => 'Color',
        ];
    }
}
