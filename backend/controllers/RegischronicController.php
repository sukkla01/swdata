<?php

namespace backend\controllers;

use Yii;

class RegischronicController extends \common\components\AppController {

    public function actionIndex() {

        $this->permitRole([1, 3]);
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        $tdate = date('Y-m-d H:m:s');
        $dataProvider='';
        $i='';
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
        
        if (Yii::$app->request->isPost) {
        $sql = "SELECT 
IF(dm_first IS NULL AND ht_first IS NOT NULL,'029',
IF(dm_first IS NOT NULL AND ht_first IS  NULL,'013',
IF(dm_first IS NOT NULL AND ht_first IS NOT NULL,'013','')) ) AS type,
tt.hn,vstdate AS regdate,'Y' AS newcase,'fmw002' AS staff,'fmw002' AS estaff,'Jubadd' AS note
FROM (
SELECT o.hn,o.vstdate,tdm.vstdate AS dm_first ,tht.vstdate AS ht_first
FROM ovstdiag o
LEFT JOIN clinicmember c ON c.hn = o.hn AND clinic IN('013','029')
LEFT JOIN (SELECT hn,min(vstdate) AS vstdate FROM ovstdiag WHERE icd10 BETWEEN 'e10' AND 'e149'   GROUP BY hn ) AS tdm ON tdm.hn=o.hn 
LEFT JOIN (SELECT hn,min(vstdate) AS vstdate FROM ovstdiag WHERE icd10 = 'i10'   GROUP BY hn ) AS tht ON tht.hn=o.hn
LEFT JOIN patient p ON p.hn=o.hn
LEFT JOIN thaiaddress t ON t.chwpart=p.chwpart AND t.amppart=p.amppart AND t.tmbpart=p.tmbpart
WHERE o.vstdate BETWEEN '$date1' AND '$date2'
			AND (icd10 BETWEEN 'e10' AND 'e149' OR icd10='i10')
			AND c.hn IS NULL
GROUP BY o.hn
UNION all
SELECT i.hn,i.dchdate,tdm.dchdate AS dm_first ,tht.dchdate AS ht_first
FROM ipt i
LEFT JOIN iptdiag d ON d.an=i.an
LEFT JOIN clinicmember c ON c.hn = i.hn AND clinic IN('013','029')
LEFT JOIN (SELECT i.hn,min(dchdate) AS dchdate FROM ipt i  LEFT JOIN iptdiag d ON d.an=i.an WHERE  icd10 BETWEEN 'e10' AND 'e149' GROUP BY i.hn ) AS tdm ON tdm.hn=i.hn 
LEFT JOIN (SELECT i.hn,min(dchdate) AS dchdate FROM ipt i  LEFT JOIN iptdiag d ON d.an=i.an WHERE  icd10 ='i10' GROUP BY i.hn ) AS tht ON tht.hn=i.hn
WHERE i.dchdate BETWEEN '$date1' AND '$date2'
			AND (icd10 BETWEEN 'e10' AND 'e149' OR icd10='i10') 
GROUP BY i.hn ) AS tt
LEFT JOIN patient p ON p.hn=tt.hn
LEFT JOIN thaiaddress t ON t.chwpart=p.chwpart AND t.amppart=p.amppart AND t.tmbpart=p.tmbpart
LEFT JOIN death d ON d.hn=tt.hn
WHERE d.hn IS NULL
GROUP BY tt.hn";
        $connection = Yii::$app->db2;
        $data = $connection->createCommand($sql)
                ->queryAll();

        for ($i = 0; $i < sizeof($data); $i++) {
            $clinic = $data[$i]['type'];
            $hn = $data[$i]['hn'];
            $regdate = $data[$i]['regdate'];
            $newcase = $data[$i]['newcase'];
            $staff = $data[$i]['staff'];
            $estaff = $data[$i]['estaff'];
            $note = $data[$i]['note'];

            $sqlid = "SELECT clinicmember_id FROM clinicmember ORDER BY clinicmember_id DESC LIMIT 1";
            $command = Yii::$app->db2->createCommand($sqlid);
            $clinicid = $command->queryScalar();
            $clinicid =$clinicid+1;
            
            $sqlInsert = "INSERT IGNORE INTO  clinicmember (clinicmember_id,clinic,hn,regdate,entry_staff,modify_staff,note,clinic_subtype_id,lastupdate) VALUES
                            ($clinicid,'$clinic','$hn','$regdate','$staff','$estaff','$note','1','$tdate') ";
            $data1 = $connection->createCommand($sqlInsert)->execute();
            Yii::$app->session->setFlash('success', 'อัพโหลดไฟล์เรียบร้อยแล้ว');
        }



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
        }


        return $this->render('index', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2,'i'=>$i]);
    }

}
