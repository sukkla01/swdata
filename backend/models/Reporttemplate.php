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
            [['reportname', 'module', 'modulename', 'url', 'staff', 'tsql'], 'string', 'max' => 255],
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
            'url' => 'route',
            'staff' => 'ผู้บันทึก',
            'tsql' => 'sql',
        ];
    }
}
