<?php

namespace frontend\controllers;
use Yii;

class File43Controller extends \common\components\AppController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionN001()
    {
        $this->permitRole([1, 3]);
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        if (isset($_GET['page'])) {
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];
        }
        if (Yii::$app->request->isPost) {
            if (isset($_POST['date1']) == '') {
                $date1 = Yii::$app->session['date1'];
                $date2 = Yii::$app->session['date2'];
            } else {

                $date1 = $_POST['date1'];
                $date2 = $_POST['date2'];
                Yii::$app->session['date1'] = $date1;
                Yii::$app->session['date2'] = $date2;
            }
        }

        $sql = "select hos.patient.hn,concat(patient.pname,patient.fname,' ',patient.lname) as PatientName, 				
	 concat(date_format(hos.opdscreen.vstdate,'%d/%m/'),year(hos.opdscreen.vstdate)+543) as vstdate  ,hos.opdscreen.bw,hos.opdscreen.waist,hos.opdscreen.bps as systolic,hos.opdscreen.bpd as diastolic,hos.opdscreen.height,hos.lab_order.lab_order_result as fbs,
	 hos.person.person_id,
	 DmHtLastYear.person_id as presonid,DmHtLastYear.last_year as yearlast ,if(hos.opdscreen.vstdate between concat(year(curdate()),'-','10','-','01') and concat(year(curdate())+1,'-','09','-','30'),year(hos.opdscreen.vstdate)+1+543,year(hos.opdscreen.vstdate)+543) as visityear , 
	case 
		when hos.person.person_id is null or hos.person.person_id = '' then 'บัญชี1'
		when !(hos.person.person_id is null or hos.person.person_id = '') and (DmHtLastYear.person_id is null or DmHtLastYear.person_id = '') then 'เพิ่ม'
     		when !(hos.person.person_id is null or hos.person.person_id = '') and !(DmHtLastYear.person_id is null or DmHtLastYear.person_id = '')
			   and (DmHtLastYear.last_year <> if(hos.opdscreen.vstdate between concat(year(curdate()),'-','10','-','01') and concat(year(curdate())+1,'-','09','-','30'),year(hos.opdscreen.vstdate)+1+543,year(hos.opdscreen.vstdate)+543) )  then 'ปีงบวันที่มาไม่ตรงกับปีงบคัดกรองล่าสุด'
		when !(hos.person.person_id is null or hos.person.person_id = '') and !(DmHtLastYear.person_id is null or DmHtLastYear.person_id = '')
			   and (DmHtLastYear.last_year = if(hos.opdscreen.vstdate between concat(year(curdate()),'-','10','-','01') and concat(year(curdate())+1,'-','09','-','30'),year(hos.opdscreen.vstdate)+1+543,year(hos.opdscreen.vstdate)+543) )  then 'ค้นหา'
	 else null end as  tckperson
from hos.opdscreen
left join hos.patient on hos.opdscreen.hn = hos.patient.hn
left join hos.person on hos.patient.hn = hos.person.patient_hn
left join (
		select  hos.person_dmht_screen_summary.person_id,max(hos.person_dmht_screen_summary.bdg_year) as last_year
		from hos.person_dmht_screen_summary 
		group by  hos.person_dmht_screen_summary.person_id 
             ) as DmHtLastYear on hos.person.person_id = DmHtLastYear.person_id   
left join hos.lab_head on hos.opdscreen.vn = hos.lab_head.vn 
left join hos.lab_order on hos.lab_head.lab_order_number = hos.lab_order.lab_order_number
LEFT JOIN (select distinct hos.ovstdiag.hn from hos.ovstdiag where (hos.ovstdiag.icd10 between 'e10' and 'e149' or hos.ovstdiag.icd10 between 'i10' and 'i159')
union  
select distinct hos.ipt.hn from hos.iptdiag left join hos.ipt on hos.iptdiag.an = hos.ipt.an where (hos.iptdiag.icd10 between 'e10' and 'e149' or  hos.iptdiag.icd10 between 'i10' and 'i159')  ) AS tt ON tt.hn = hos.opdscreen.hn
where hos.opdscreen.vstdate between '$date1' and '$date2'
and  tt.hn IS NULL
and hos.lab_order.lab_items_code   = 76 
order by 14 desc ";
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 20
            ],
        ]);
        return $this->render('n001', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2, 'sql', $sql]);
    }
    
   

}
