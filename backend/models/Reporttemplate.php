<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reporttemplate".
 *
 * @property integer $id
 * @property string $reportname
 * @property string $module
 * @property string $modulename
 * @property string $url
 * @property string $staff
 * @property string $tsql
 * @property string $create_date
 */
class Reporttemplate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reporttemplate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tsql'], 'string'],
            [['create_date'], 'safe'],
            [['reportname', 'module', 'modulename', 'url', 'staff'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reportname' => 'ชื่อรายงาน',
            'module' => 'Module',
            'modulename' => 'ชื่อ Module',
            'url' => 'Route',
            'staff' => 'Staff',
            'tsql' => 'Sql',
            'create_date' => 'วันที่สร้าง',
        ];
    }
}
