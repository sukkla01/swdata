<?php

namespace frontend\controllers;

use Yii;

class ReportsmoController extends \common\components\AppController {

    public function actionHdugfr() {

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

        $sql = "select p.hn,concat(pname,fname,' ',lname) as tname,lo.lab_order_result,p.sex,IF(vs.age_y IS NULL,a.age_y,vs.age_y) as age,a.an,a.age_y,
                                     if(department='OPD',s.name,w.name) as tspclty,l.vn,albu.lab_order_result AS albu_result,micro.lab_order_result AS micro_result,TEST.lab_order_result AS test_result,
                                     concat(p.addrpart,'  ',p.moopart,' ' ,t.full_name) as addrfull,pt.name as ptname,department,
								 p.addressid,p.moopart,p.tmbpart,p.amppart,p.chwpart,											
                                     if(department='OPD',concat(vs.dx0,' ',vs.dx1,' ',vs.dx2,' ',vs.dx3,' ',vs.dx4),concat(a.dx0,a.dx1,a.dx2,a.dx3,a.dx4)) as icd10dx,
                                     if(p.sex=1,if(lo.lab_order_result<=0.9,141 * exp(-0.411 * log(lo.lab_order_result / 0.9)) * exp((IF(vs.age_y IS NULL,a.age_y,vs.age_y))* log(0.993)),141 * exp(-1.209 * log(lo.lab_order_result/ 0.9)) * exp((IF(vs.age_y IS NULL,a.age_y,vs.age_y)) * log(0.993))),
                                     if(lo.lab_order_result<= 0.7,144 * exp(-0.329 * log(lo.lab_order_result / 0.7)) * exp((IF(vs.age_y IS NULL,a.age_y,vs.age_y)) * log(0.993)),144 * exp(-1.209 * log(lo.lab_order_result/ 0.7)) * exp((IF(vs.age_y IS NULL,a.age_y,vs.age_y))  * log(0.993)))) as gfr
														
                                     from lab_head l
                                     left join lab_order lo on lo.lab_order_number=l.lab_order_number
                                     left join patient p on p.hn=l.hn
                                     left join thaiaddress t on t.chwpart=p.chwpart and t.amppart=p.amppart and t.tmbpart=p.tmbpart
                                     left join ovst o on o.vn=l.vn
                                     left join pttype pt on pt.pttype=o.pttype
                                     left join ipt i on i.an=l.vn
                                     left join spclty s on s.spclty=o.spclty
                                     left join ward w on w.ward=i.ward
                                     left join vn_stat vs on vs.vn=o.vn
                                     left join an_stat a on a.an=i.an
					LEFT JOIN (SELECT lab_items_code,lab_order_result,vn
																								FROM  lab_head l
																								LEFT JOIN lab_order lo ON lo.lab_order_number =l.lab_order_number
																								WHERE  lo.lab_items_code IN('364','524')) AS albu ON albu.vn=l.vn
				    LEFT JOIN (SELECT lab_items_code,lab_order_result,vn
																								FROM  lab_head l
																								LEFT JOIN lab_order lo ON lo.lab_order_number =l.lab_order_number
																								WHERE  lo.lab_items_code ='588' group by vn ) AS micro ON micro.vn=l.vn
                                     LEFT JOIN (SELECT lab_items_code,lab_order_result,vn
																								FROM  lab_head l
																								LEFT JOIN lab_order lo ON lo.lab_order_number =l.lab_order_number
																								WHERE  lo.lab_items_code ='618' group by vn ) AS TEST ON TEST.vn=l.vn
                                     where l.order_date between  '$date1' and '$date2'   and lo.lab_items_code='78' and  o.spclty IN('13','47')";
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
        return $this->render('hdugfr', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2]);
    }

    public function actionNotclinic() {
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

        $sql = "SELECT tt.*,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,
                CONCAT(p.addrpart,' หมู่ ',p.moopart,' ',t.full_name) taddr,
                p.moopart,p.tmbpart,p.amppart,p.chwpart,
                IF(dm_first IS NULL AND ht_first IS NOT NULL,'DM',
                IF(dm_first IS NOT NULL AND ht_first IS  NULL,'HT',
                IF(dm_first IS NOT NULL AND ht_first IS NOT NULL,'DMHT','')) ) AS type
                FROM (
                SELECT o.hn,o.vstdate,tdm.vstdate AS dm_first ,tht.vstdate AS ht_first
                FROM ovstdiag o
                LEFT JOIN clinicmember c ON c.hn = o.hn
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
                LEFT JOIN clinicmember c ON c.hn = i.hn
                LEFT JOIN (SELECT i.hn,min(dchdate) AS dchdate FROM ipt i  LEFT JOIN iptdiag d ON d.an=i.an WHERE  icd10 BETWEEN 'e10' AND 'e149' GROUP BY i.hn ) AS tdm ON tdm.hn=i.hn 
                LEFT JOIN (SELECT i.hn,min(dchdate) AS dchdate FROM ipt i  LEFT JOIN iptdiag d ON d.an=i.an WHERE  icd10 ='i10' GROUP BY i.hn ) AS tht ON tht.hn=i.hn
                WHERE i.dchdate BETWEEN '$date1' AND '$date2'
                                        AND (icd10 BETWEEN 'e10' AND 'e149' OR icd10='i10') 
                GROUP BY i.hn ) AS tt
                LEFT JOIN patient p ON p.hn=tt.hn
                LEFT JOIN thaiaddress t ON t.chwpart=p.chwpart AND t.amppart=p.amppart AND t.tmbpart=p.tmbpart
                GROUP BY tt.hn";
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
            /*'sort' => [
                'attributes' => count($rawData[0]) > 0 ? array_keys($rawData[0]) : array()
            ]*/
        ]);
        return $this->render('notclinic', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2]);
    }
    
    public function actionNcdhdc() {
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

        $sql = "SELECT t1.*,IF(t2.pid IS NULL,'','Y') AS tdm,t2.DATE_SERV AS datedm,IF(t3.pid IS NULL,'','Y') AS tht,t3.DATE_SERV AS dateht
                FROM (
                SELECT n.DATE_SERV,p.cid,CONCAT(c.prename,p.NAME,' ',p.LNAME)  AS tname,YEAR(CURDATE())-YEAR(p.BIRTH)  AS tage,SBP_1,SBP_2,DBP_1,DBP_2,BSLEVEL,n.pid
                FROM ncdscreen n
                LEFT JOIN person p ON p.PID = n.PID AND p.HOSPCODE = n.HOSPCODE
                LEFT JOIN cprename c ON c.id_prename=p.PRENAME
                #LEFT JOIN diagnosis_opd d ON   d.HOSPCODE= n.HOSPCODE AND d.PID = n.PID AND  d.DIAGCODE BETWEEN 'e10' AND 'e149'
                WHERE n.DATE_SERV BETWEEN '$date1' AND '$date2' AND n.HOSPCODE='10725' ) AS t1
                LEFT JOIN (SELECT pid,HOSPCODE,DATE_SERV FROM diagnosis_opd WHERE HOSPCODE ='10725' AND DIAGCODE BETWEEN 'e10' AND 'e149' AND DATE_SERV BETWEEN '$date1' AND '$date2' GROUP BY pid)  AS t2 ON t2.pid = t1.pid
                LEFT JOIN (SELECT pid,HOSPCODE,DATE_SERV FROM diagnosis_opd WHERE HOSPCODE ='10725' AND DIAGCODE BETWEEN 'i10' AND 'i15' AND DATE_SERV BETWEEN '$date1' AND '$date2' GROUP BY pid)  AS t3 ON t3.pid = t1.pid

                ";
        try {
            $rawData = \Yii::$app->db3->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 100
            ],
            /*'sort' => [
                'attributes' => count($rawData[0]) > 0 ? array_keys($rawData[0]) : array()
            ]*/
        ]);
        return $this->render('ncdhdc', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2]);
    }
    
     public function actionDmxray() {
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

        $sql = "SELECT *
                FROM (
                SELECT o.hn,o.vn,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,p.cid,
                CONCAT(p.addrpart,' หมู่ ',p.moopart,' ',t.full_name) taddr,
                p.moopart,p.tmbpart,p.amppart,p.chwpart,v.age_y,'OPD' AS type,
                x.order_date_time,xray_list
                FROM ovstdiag o
                INNER JOIN xray_head x ON x.vn = o.vn
                LEFT JOIN patient p ON p.hn = o.hn
                LEFT JOIN vn_stat v ON v.vn = o.vn
                LEFT JOIN thaiaddress t ON t.chwpart=p.chwpart AND t.amppart=p.amppart AND t.tmbpart=p.tmbpart
                WHERE o.vstdate BETWEEN '$date1' AND '$date2'
                      AND icd10 BETWEEN 'e10' AND 'e149'
                      AND v.age_y >60
                UNION ALL
                SELECT i.hn,i.an,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,p.cid,
                CONCAT(p.addrpart,' หมู่ ',p.moopart,' ',t.full_name) taddr,
                p.moopart,p.tmbpart,p.amppart,p.chwpart,a.age_y,'IPD' AS type,
                x.order_date_time,xray_list
                FROM ipt i 
                LEFT JOIN iptdiag d ON d.an=i.an
                INNER JOIN xray_head x ON x.vn = i.an
                LEFT JOIN patient p ON p.hn = i.hn
                LEFT JOIN thaiaddress t ON t.chwpart=p.chwpart AND t.amppart=p.amppart AND t.tmbpart=p.tmbpart
                LEFT JOIN an_stat a ON a.an = i.an
                WHERE i.dchdate BETWEEN '$date1' AND '$date2'
                      AND icd10 BETWEEN 'e10' AND 'e149'
                      AND a.age_y >60 ) AS tt
                ORDER BY tt.chwpart,tt.amppart,tt.tmbpart,tt.moopart";
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
        return $this->render('dmxray', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2]);
    }

    public function actionIndex() {
        return $this->render('index');
    }

}
