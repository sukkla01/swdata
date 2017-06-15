<?php

namespace app\modules\oapp\models;

use Yii;

/**
 * This is the model class for table "oapp_event".
 *
 * @property integer $id
 * @property string $hn
 * @property string $tname
 * @property integer $cid
 * @property string $pttype
 * @property string $tel
 * @property string $created_date
 * @property string $note1
 * @property string $note2
 * @property string $note3
 * @property string $spclty
 * @property string $pttype_name
 */
class OappEvent extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'oapp_event';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb() {
        return Yii::$app->get('db5');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['cid', 'hn', 'tname','tel'], 'required'],
                [['cid'], 'integer'],
                [['created_date'], 'string','max' => 50],
                [['hn', 'spclty'], 'string', 'max' => 10],
                [['tname', 'pttype', 'note1', 'note2', 'note3','pttype_name'], 'string', 'max' => 255],
                [['tel'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'hn' => 'HN',
            'tname' => 'ชื่อ-สกุล',
            'cid' => 'เลขบัตรประชาชน',
            'pttype' => 'สิทธิ์การรักษา',
            'tel' => 'เบอร์โทร',
            'created_date' => 'วันที่นัด',
            'note1' => 'Note1',
            'note2' => 'Note2',
            'note3' => 'Note3',
            'spclty' => 'Spclty',
            'pttype_name' => 'สิทธิ',
        ];
    }

}
