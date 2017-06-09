<?php

namespace app\modules\quest\models;

use Yii;

/**
 * This is the model class for table "dep".
 *
 * @property integer $DEPTID
 * @property string $DEPTNAME
 * @property string $DepJob
 * @property string $DEPTNAMEnew
 * @property string $fstatus
 * @property string $fstatustime
 * @property string $DepJob_old
 */
class Dep extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dep';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DEPTID'], 'integer'],
            [['DEPTNAME', 'DEPTNAMEnew'], 'string', 'max' => 50],
            [['DepJob', 'DepJob_old'], 'string', 'max' => 3],
            [['fstatus', 'fstatustime'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DEPTID' => 'Deptid',
            'DEPTNAME' => 'Deptname',
            'DepJob' => 'Dep Job',
            'DEPTNAMEnew' => 'Deptnamenew',
            'fstatus' => 'Fstatus',
            'fstatustime' => 'Fstatustime',
            'DepJob_old' => 'Dep Job Old',
        ];
    }
}
