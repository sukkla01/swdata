<?php

namespace app\modules\quest\models;

use Yii;

/**
 * This is the model class for table "quest".
 *
 * @property integer $id
 * @property string $tname
 * @property string $age
 * @property string $position
 * @property string $dept
 * @property string $inject_date
 * @property string $inject_time
 * @property string $mm
 * @property string $pb
 * @property string $ns
 * @property string $pk
 * @property string $pl
 * @property string $nt
 * @property string $td
 * @property string $ps
 * @property string $pi
 * @property string $ot
 * @property string $s_mm
 * @property string $s_pb
 * @property string $s_kh
 * @property string $s_ns
 * @property string $s_pk
 * @property string $s_pl
 * @property string $s_nt
 * @property string $s_td
 * @property string $s_ps
 * @property string $s_pi
 * @property string $s_ot
 * @property string $e_mm
 * @property string $e_pb
 * @property string $e_kh
 * @property string $e_ns
 * @property string $e_pk
 * @property string $e_pl
 * @property string $e_nt
 * @property string $e_td
 * @property string $e_ps
 * @property string $e_pi
 * @property string $e_ot
 */
class Quest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inject_date', 'inject_time', 's_mm', 's_pb', 's_kh', 's_ns', 's_pk', 's_pl', 's_nt', 's_td', 's_ps', 's_pi', 's_ot', 'e_mm', 'e_pb', 'e_kh', 'e_ns', 'e_pk', 'e_pl', 'e_nt', 'e_td', 'e_ps', 'e_pi', 'e_ot'], 'safe'],
            [['tname', 'position', 'mm', 'pb', 'ns', 'pk', 'pl', 'nt', 'td', 'ps', 'pi', 'ot'], 'string', 'max' => 255],
            [['dept'], 'string', 'max' => 10],
            [['age'], 'integer', 'max' => 120],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tname' => 'ชื่อ-สกุล',
            'age' => 'อายุ',
            'position' => 'ตำแหน่ง',
            'dept' => 'แผนก',
            'inject_date' => 'วันที่ฉีด',
            'inject_time' => 'เวลาฉีด',
            'mm' => 'ไม่มีอาการข้างเคียง',
            'pb' => 'ปวด บวมแดง บริเวณที่ฉีด',
            'ns' => 'ไข้',
            'pk' => 'หนาวสั่น',
            'pl' => 'Pl',
            'nt' => 'Nt',
            'td' => 'Td',
            'ps' => 'Ps',
            'pi' => 'Pi',
            'ot' => 'Ot',
            's_mm' => 'เริ่มวันที่',
            's_pb' => 'เริ่มวันที่',
            's_kh' => 'เริ่มวันที่',
            's_ns' => 'เริ่มวันที่',
            's_pk' => 'เริ่มวันที่',
            's_pl' => 'เริ่มวันที่',
            's_nt' => 'เริ่มวันที่',
            's_td' => 'เริ่มวันที่',
            's_ps' => 'เริ่มวันที่',
            's_pi' => 'เริ่มวันที่',
            's_ot' => 'เริ่มวันที่',
            'e_mm' => 'ถึงวันที่',
            'e_pb' => 'ถึงวันที่',
            'e_kh' => 'ถึงวันที่',
            'e_ns' => 'ถึงวันที่',
            'e_pk' => 'ถึงวันที่',
            'e_pl' => 'ถึงวันที่',
            'e_nt' => 'ถึงวันt',
            'e_td' => 'ถึงวันที่',
            'e_ps' => 'ถึงวันที่',
            'e_pi' => 'ถึงวันที่',
            'e_ot' => 'ถึงวันที่',
        ];
    }
}
