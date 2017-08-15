<?php

namespace app\modules\rreport\models;

use Yii;

/**
 * This is the model class for table "report_request".
 *
 * @property integer $id
 * @property string $detail
 * @property string $user
 * @property string $header
 * @property string $status
 * @property string $date_line
 * @property string $staff
 */
class ReportRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'report_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['date_line'], 'safe'],
            [['detail', 'user', 'header', 'status', 'staff'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'detail' => 'Detail',
            'user' => 'User',
            'header' => 'Header',
            'status' => 'Status',
            'date_line' => 'Date Line',
            'staff' => 'Staff',
        ];
    }
}
