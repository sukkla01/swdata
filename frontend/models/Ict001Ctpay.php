<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ict001_ctpay".
 *
 * @property string $hos_guid
 * @property string $vstdate
 * @property string $rxdate
 * @property string $vn
 * @property string $hn
 * @property string $an
 * @property string $fullname
 * @property string $ward
 * @property string $wardname
 * @property string $dep_code
 * @property string $department
 * @property string $icode
 * @property string $drugname
 * @property string $billcode
 * @property integer $qty
 * @property double $unitprice
 * @property string $pttype
 * @property string $pttypename
 * @property string $income
 * @property string $paidst
 * @property string $sum_price
 * @property string $reason
 * @property string $necessary
 * @property string $payprice
 * @property string $command_doctor
 * @property integer $age_y
 * @property string $CTstatus
 */
class Ict001Ctpay extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ict001_ctpay';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hos_guid'], 'required'],
            [['vstdate', 'rxdate'], 'safe'],
            [['qty', 'age_y'], 'integer'],
            [['unitprice', 'sum_price', 'payprice'], 'number'],
            [['hos_guid', 'drugname'], 'string', 'max' => 100],
            [['vn', 'an'], 'string', 'max' => 15],
            [['hn', 'icode', 'billcode'], 'string', 'max' => 7],
            [['fullname', 'department'], 'string', 'max' => 60],
            [['ward', 'pttype', 'income', 'paidst'], 'string', 'max' => 2],
            [['wardname', 'pttypename'], 'string', 'max' => 40],
            [['dep_code'], 'string', 'max' => 3],
            [['reason'], 'string', 'max' => 255],
            [['necessary'], 'string', 'max' => 50],
            [['command_doctor'], 'string', 'max' => 5],
            [['CTstatus'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hos_guid' => 'Hos Guid',
            'vstdate' => 'Vstdate',
            'rxdate' => 'Rxdate',
            'vn' => 'Vn',
            'hn' => 'Hn',
            'an' => 'An',
            'fullname' => 'Fullname',
            'ward' => 'Ward',
            'wardname' => 'Wardname',
            'dep_code' => 'Dep Code',
            'department' => 'Department',
            'icode' => 'Icode',
            'drugname' => 'Drugname',
            'billcode' => 'Billcode',
            'qty' => 'Qty',
            'unitprice' => 'Unitprice',
            'pttype' => 'Pttype',
            'pttypename' => 'Pttypename',
            'income' => 'Income',
            'paidst' => 'Paidst',
            'sum_price' => 'Sum Price',
            'reason' => 'Reason',
            'necessary' => 'Necessary',
            'payprice' => 'Payprice',
            'command_doctor' => 'Command Doctor',
            'age_y' => 'Age Y',
            'CTstatus' => 'Ctstatus',
        ];
    }
}
