<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "finger_download".
 *
 * @property string $year
 * @property string $month
 * @property string $file1
 * @property string $file2
 * @property string $file3
 * @property string $file4
 * @property string $note1
 */
class FingerDownload extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    
    const UPLOAD_FOLDER = 'finger';
    
    
    public static function tableName() {
        return 'finger_download';
    }

    public static function getUploadPath() {
        return Yii::getAlias('@webroot') . '/' . self::UPLOAD_FOLDER . '/';
    }

    public static function getUploadUrl() {
        return Url::base(true) . '/' . self::UPLOAD_FOLDER . '/';
    }

    public function rules() {
        return [
                [['year', 'month'], 'required'],
                [['year', 'month'], 'string', 'max' => 5],
                [['file1', 'file2', 'file3', 'file4'], 'file', 'maxFiles' => 1],
                 [['note1'],'string','max'=>255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'year' => 'ปี',
            'month' => 'เดือน',
            'file1' => 'File1',
            'file2' => 'File2',
            'file3' => 'File3',
            'file4' => 'File4',
            'note1' => 'หมายเหตุ',
        ];
    }

}
