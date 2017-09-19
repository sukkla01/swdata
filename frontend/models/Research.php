<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "research".
 *
 * @property integer $id
 * @property string $projectname
 * @property string $research_name
 * @property integer $project_no
 * @property string $dept
 * @property string $date_comfirm
 * @property string $note1
 * @property string $note2
 */
class Research extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'research';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_no'], 'required'],
            [['id',], 'integer'],
            [['date_comfirm'], 'safe'],
            [['projectname', 'research_name', 'dept', 'note1', 'note2','project_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'projectname' => 'ชื่อโครงการ',
            'research_name' => 'ชื่อผู้วิจัย Name',
            'project_no' => 'เลขที่โครงการ',
            'dept' => 'สังกัดหน่วยงาน',
            'date_comfirm' => 'วันที่รับรอง',
            'note1' => 'ชื่อประธาน',
            'note2' => 'Note2',
        ];
    }
}
