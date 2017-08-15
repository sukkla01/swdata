<?php

namespace app\modules\rreport\models;

use Yii;

/**
 * This is the model class for table "ward".
 *
 * @property string $ward
 * @property string $name
 * @property string $old_code
 * @property string $spclty
 * @property integer $bedcount
 * @property string $shortname
 * @property string $sss_code
 * @property string $ecode
 * @property string $hos_guid
 */
class Ward extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ward';
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
            [['ward'], 'required'],
            [['bedcount'], 'integer'],
            [['ward'], 'string', 'max' => 4],
            [['name'], 'string', 'max' => 250],
            [['old_code'], 'string', 'max' => 3],
            [['spclty'], 'string', 'max' => 2],
            [['shortname', 'ecode'], 'string', 'max' => 20],
            [['sss_code'], 'string', 'max' => 10],
            [['hos_guid'], 'string', 'max' => 38],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ward' => 'Ward',
            'name' => 'Name',
            'old_code' => 'Old Code',
            'spclty' => 'Spclty',
            'bedcount' => 'Bedcount',
            'shortname' => 'Shortname',
            'sss_code' => 'Sss Code',
            'ecode' => 'Ecode',
            'hos_guid' => 'Hos Guid',
        ];
    }
}
