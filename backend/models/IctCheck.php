<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ict_check".
 *
 * @property integer $id
 * @property string $host
 * @property string $detail
 * @property string $port
 */
class IctCheck extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ict_check';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['host', 'detail', 'port'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'host' => 'Host',
            'detail' => 'Detail',
            'port' => 'Port',
        ];
    }
}
