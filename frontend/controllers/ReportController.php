<?php

namespace frontend\controllers;

use Yii;

class ReportController extends \common\components\AppController {

    public function actionIndex() {
        $this->permitRole([1, 3]);
        return $this->render('index');
    }

    public function actionTsql() {

        return $this->render('tsql');
    }

    public function actionMrs001() {
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
        if (isset($_GET['date1'])) {
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];
        }

        $sql = "SELECT t1.*,COUNT(t1.an) AS tcount,$date1 as date1,$date2 as date2
                FROM (
                select distinct(a.an),a.hn,concat(p.pname,p.fname,' ',p.lname) as PatientName,ia.admday,i.adjrw,ds.name as dchstts,dt.name as dchtype,
                                                                                max(idl.ipt_diagnosis_log_date) as datemodify,
                                a.pdx,icdpdx.name,a.dx0,a.dx1,a.dx2,a.dx3,a.dx4,a.dx5,a.op0,a.op1,a.op2,a.op3,a.op4,a.op5,a.op6
                                from an_stat a
                                left join iptdiag id on a.an = id.an
                                left join icd9cm1 i90 on a.op0 = i90.code
                                left join icd9cm1 i91 on a.op1 = i91.code
                                left join icd9cm1 i92 on a.op2 = i92.code
                                left join icd9cm1 i93 on a.op3 = i93.code
                                left join icd9cm1 i94 on a.op4 = i94.code
                                left join icd9cm1 i95 on a.op5 = i95.code
                                left join icd9cm1 i96 on a.op6 = i96.code

                                left join icd101 icdpdx on a.pdx = icdpdx.code
                                left join icd101 icd0 on a.dx0 = icd0.code
                                left join icd101 icd1 on a.dx1 = icd1.code
                                left join icd101 icd2 on a.dx2 = icd2.code
                                left join icd101 icd3 on a.dx3 = icd3.code
                                left join icd101 icd4 on a.dx4 = icd4.code
                                left join icd101 icd5 on a.dx5 = icd5.code

                                left join patient p on a.hn = p.hn
                                left join ipt i on a.an = i.an
                                left join iptadm  ia on a.an = ia.an
                                left join dchstts ds on i.dchstts  = ds.dchstts 
                                left join dchtype dt on i.dchtype = dt.dchtype
                                left join ipt_diagnosis_log idl on i.an = idl.an
                                where idl.ipt_diagnosis_log_date between '$date1' and '$date2'
                                group by a.an ) AS t1
                LEFT JOIN (SELECT i.an FROM iptdiag i LEFT JOIN ipt_diagnosis_log l ON l.an =i.an  where l.ipt_diagnosis_log_date between '$date1' and '$date2' GROUP BY an,icd10  ) t2 ON t2.an = t1.an
                GROUP BY t1.an  ";
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 100
            ],
        ]);
        return $this->render('mrs001', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2]);
    }

    public function actionMrs1detail() {

        $an = $_GET['an'];
        $date1 = $_GET['date1'];
        $date2 = $_GET['date2'];
        return $this->renderAjax('mrs1detail', ['an' => $an, 'date1' => $date1, 'date2' => $date2]);
    }

    public function actionMrs002() {
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
        $sql = "SELECT tt.*,
                IF((cdeath BETWEEN 'r00' AND 'r99' OR cdeath BETWEEN 'y10' AND 'y34' 
                     OR cdeath IN('c80','c97','i472','i490','i46','i50','i514','i515','i516','i519','i709','','CODE')),'error','complete') AS tcheck
                FROM (								
                SELECT t.hn,p.cid,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,
                death_diag_1,death_diag_2,death_diag_3,death_diag_4,
                IF(tsum=1,death_diag_1,IF(tsum=3,death_diag_2,IF(tsum=6,death_diag_3,death_diag_4))) AS cdeath
                FROM (
                SELECT hn,cid,death_diag_1,death_diag_2,death_diag_3,death_diag_4,
                (IF(death_diag_1 <>'',1,0 ) + IF(death_diag_2 <>'',2,0 ) +
                IF(death_diag_3 <>'',3,0 ) +
                IF(death_diag_4 <>'',4,0 )) AS tsum 
                FROM death 
                WHERE death_date BETWEEN '$date1' and '$date2' ) AS t
                LEFT JOIN patient p ON p.hn=t.hn ) AS tt
               ";
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
        return $this->render('mrs002', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2]);
    }

    public function actionMrs003() {
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
        $sql = "SELECT  v.hn,v.vn,v.income,v.vstdate,v.pttype,
                        d.staff,
                        s.name as spclty_name,
                        p.last_visit,p.admit,
                        substring(os.cc,1,255) as cc,
                        substring(os.symptom,1,255) as symptom,
                        v.pdx,v.dx0,v.dx1,v.dx2,v.dx3,v.dx4,v.dx5
                FROM opitemrece o
                LEFT JOIN vn_stat v ON v.vn = o.vn
                LEFT JOIN ovstdiag d ON d.vn = o.vn
                left join opdscreen os on os.vn = o.vn
                left join spclty s on v.spclty = s.spclty
                left join patient p on p.hn = o.hn
                WHERE o.vstdate BETWEEN '$date1' AND '$date2'
                                        AND (v.pdx is null or v.pdx = '' or v.pdx = ' ' OR d.staff IN('Jub_auto','001_auto') )
			AND o.icode not in ('3000976','3000977')
			AND (o.an is null or o.an = '' or o.an = ' ' )
                group by o.vn ";
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
        return $this->render('mrs003', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2]);
    }

    public function actionDrugning() {
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

        $sql = "SELECT o.icode,d.name AS dname,SUM(o.qty) AS tqty,SUM(sum_price) AS tsum,SUM(o.qty)*cost AS tscost,
                drugcategory,IF(LENGTH(an)=9,'IPD','OPD')  AS type
                FROM opitemrece o
                LEFT JOIN drugitems d ON d.icode=o.icode
                WHERE o.vstdate BETWEEN  '$date1' and '$date2'
			AND o.income IN('04','03','17')
			AND (drugcategory IN('arv','NON-ANTIRETROVIRAL','ANTIVIRAL DRUGS','ANTI-TUBERCULOSIS',
                                            'ANTI-MALARIAL DRUGS','ANTIINFECTIVE','ANTIBACTERIALS AND EYE WASH SOLUTION',
                                            'ANTIBACTERIALS WITH CORTICOSTEROIDS','')
                             OR o.icode IN('1900673','1900747','1900685','1900683') )
                GROUP BY o.icode
                ORDER BY tqty DESC";
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 50
            ],
        ]);
        return $this->render('drugning', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2, 'sql', $sql]);
    }

    public function actionDrug4() {
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

        $sql = "SELECT IF(v.vn IS NULL,a.hn,v.hn) AS thn,
		IF(v.vn IS NULL,'IPD','OPD') AS ttype,t1.*,t2.*,t3.*
                FROM ( SELECT vn as vn1,rxdate as rxdate1 ,qty as qty1,sum_price as sumprice1 FROM opitemrece_summary WHERE rxdate BETWEEN '$date1' AND '$date2' AND icode = '1900174' ) AS t1
                LEFT JOIN  (SELECT vn as vn2,rxdate,qty as qty2,IF(sum_price IS NULL,'1',sum_price) AS sumprice2 FROM opitemrece_summary WHERE rxdate BETWEEN '$date1' AND '$date2' AND icode = '1900228' ) AS t2 ON t2.vn2 = t1.vn1 AND t2.rxdate = t1.rxdate1
                LEFT JOIN  (SELECT vn as vn3,rxdate,qty as qty3,IF(sum_price IS NULL,'1',sum_price) AS sumprice3 FROM opitemrece_summary WHERE rxdate BETWEEN '$date1' AND '$date2' AND icode = '1900242' ) AS t3 ON t3.vn3 = t1.vn1  AND t3.rxdate = t1.rxdate1
                LEFT JOIN vn_stat v ON v.vn = t1.vn1
                LEFT JOIN an_stat a ON a.an = t1.vn1
                HAVING t2.vn2 IS NOT NULL OR t3.vn3 IS NOT NULL";
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 50
            ],
        ]);
        return $this->render('drug4', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2, 'sql', $sql]);
    }

    public function actionDrugbrimo() {
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

        $sql = "SELECT tt.*,
                if(inpttype<>0,COUNT(DISTINCT inpttype ),0) AS p1,
                if(outpttype<>0,COUNT(DISTINCT outpttype ),0) AS p2,
                SUM(qty) AS tqty
                FROM (
                SELECT  o.pttype,p.name,
                IF(v.hospmain='10725',o.hn,0) AS Inpttype,
                IF(v.hospmain<>'10725',o.hn,0) AS Outpttype,
                o.qty
                FROM opitemrece  o
                LEFT JOIN ovst v ON v.vn = o.vn
                LEFT JOIN pttype p ON p.pttype = o.pttype
                WHERE rxdate BETWEEN '$date1' and '$date2'
                                        AND o.icode = '1510007' ) AS tt
                GROUP BY pttype";
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 50
            ],
        ]);
        return $this->render('drugbrimo', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2, 'sql', $sql]);
    }

    public function actionAntibac() {
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

        $sql = "SELECT o.icode,d.name AS dname,SUM(o.qty) AS tqty,SUM(sum_price) AS tsum,SUM(o.qty)*cost AS tscost,
                drugcategory,IF(LENGTH(an)=9,'IPD','OPD')  AS type
                FROM opitemrece o
                LEFT JOIN drugitems d ON d.icode=o.icode
                WHERE o.vstdate BETWEEN  '$date1' and '$date2'
			AND o.income IN('04','03','17')
			AND drugcategory = 'ANTIBACTERIALS'
                GROUP BY o.icode
                ORDER BY tqty DESC";
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 50
            ],
        ]);
        return $this->render('antibac', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2, 'sql', $sql]);
    }

    public function actionN18() {
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
        $sql = "SELECT a.*
                FROM (
                SELECT o.hn AS hn1,o.vstdate,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,icd10,v.age_y
                FROM ovstdiag o
                LEFT JOIN patient p on p.hn= o.hn
                LEFT JOIN vn_stat v ON v.vn = o.vn
                WHERE o.vstdate BETWEEN '$date1' AND '$date2'
                      AND (icd10 BETWEEN 'n181' AND 'n185' OR icd10 ='n189')
                GROUP BY o.hn ) AS a
                LEFT JOIN (SELECT hn FROM clinicmember WHERE clinic IN('013','029') ) AS t on t.hn = a.hn1
                WHERE  t.hn IS NULL
             ";
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
        return $this->render('n18', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2]);
    }

    public function actionN181() {
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
                SELECT o.hn,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,CONCAT(p.addrpart,' หมู่ ',p.moopart,' ',t.full_name) taddr,
                p.moopart,p.tmbpart,p.amppart,p.chwpart,cid,
                                                SUM(IF(c1.hn IS NOT null,1,0)) AS  ht,
                                                SUM(IF(c2.hn IS NOT null,1,0)) AS  dm,
                                                'OPD' AS type,o.vstdate,s.name as sname,icd10
                FROM ovstdiag o
                LEFT JOIN (SELECT hn FROM clinicmember WHERE clinic ='029')  c1 ON c1.hn = o.hn
                LEFT JOIN (SELECT hn FROM clinicmember WHERE clinic ='013')  c2 ON c2.hn = o.hn
                LEFT JOIN patient p ON p.hn = o.hn
		LEFT JOIN thaiaddress t ON t.chwpart=p.chwpart AND t.amppart=p.amppart AND t.tmbpart=p.tmbpart
                LEFT JOIN  ovst v on v.vn=o.vn
                LEFT JOIN  spclty s on s.spclty = v.spclty
                WHERE o.vstdate BETWEEN '$date1' AND '$date2'
                      AND icd10 IN('n181','n182','n183','n184','n185','n189')
                GROUP BY o.hn,o.vstdate,icd10
                UNION ALL
                SELECT i.hn,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,CONCAT(p.addrpart,' หมู่ ',p.moopart,' ',t.full_name) taddr,
                p.moopart,p.tmbpart,p.amppart,p.chwpart,cid,
                                                SUM(IF(c1.hn IS NOT null,1,0)) AS  ht,
                                                SUM(IF(c2.hn IS NOT null,1,0)) AS  dm,
                                                'IPD' AS type,
                                                dchdate as vstdate,s.name as sname,icd10
                FROM ipt i
                LEFT JOIN iptdiag d ON d.an =i.an
                LEFT JOIN (SELECT hn FROM clinicmember WHERE clinic ='029')  c1 ON c1.hn = i.hn
                LEFT JOIN (SELECT hn FROM clinicmember WHERE clinic ='013')  c2 ON c2.hn = i.hn
                LEFT JOIN patient p ON p.hn = i.hn
		LEFT JOIN thaiaddress t ON t.chwpart=p.chwpart AND t.amppart=p.amppart AND t.tmbpart=p.tmbpart
                LEFT JOIN  spclty s on s.spclty = i.spclty
                WHERE i.dchdate BETWEEN '$date1' AND '$date2'
                                        AND icd10 IN('n181','n182','n183','n184','n185','n189') 
                GROUP BY i.hn,i.dchdate,icd10  ) AS t1
                ORDER BY hn  ";
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
        return $this->render('n181', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2]);
    }

    public function actionDrug3() {
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
        $sql = "SELECT o.rxdate,
                IF(o.an IS NULL,'OPD','IPD') AS typet,
                o.hn,IF(o.an IS NULL,o.vn,o.an) AS tvn,
                CONCAT(p.pname,p.fname,'',p.fname) AS tname,
                IF(o.an IS NULL,v.pdx,a.pdx) AS ticd10,
                d.name AS dname,o.qty,o.sum_price
                FROM opitemrece o
                LEFT JOIN patient p ON p.hn = o.hn
                LEFT JOIN vn_stat v ON v.vn = o.vn
                LEFT JOIN an_stat a ON a.an = o.an
                LEFT JOIN drugitems d ON d.icode = o.icode
                WHERE o.rxdate BETWEEN '$date1' AND '$date2'
                      AND o.icode IN('1900242','1550019','1900227','1900228','1900170')
                ORDER BY o.hn  ";
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
        return $this->render('drug3', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2]);
    }

    public function actionDmin() {
        $this->permitRole([1, 3]);
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        $tyear = date('Y');
        $type='';
        if (isset($_GET['page'])) {
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];
        }
      
        
        if (Yii::$app->request->isPost) {
            if (isset($_POST['type']) == '') {
                $type = Yii::$app->session['type'];
            } else {

                $type = $_POST['type'];
                Yii::$app->session['type'] = $type;
            }
        }

        if ($type == '0') {
            $tyear =date('Y')-3;
        }else if($type == '1'){
             $tyear =date('Y')-2;
        }else if($type == '2'){
             $tyear =date('Y')-1;
        }else if($type == '3'){
             $tyear =date('Y');
        }



        $sql = "SELECT t1.*,l10.lab_order_result AS l10,l11.lab_order_result AS l11,l12.lab_order_result AS l12
				,l01.lab_order_result AS l01,l02.lab_order_result AS l02,l03.lab_order_result AS l03
				,l04.lab_order_result AS l04,l05.lab_order_result AS l05,l06.lab_order_result AS l06
				,l07.lab_order_result AS l07,l08.lab_order_result AS l08,l09.lab_order_result AS l09,
                                moopart
FROM (
SELECT vstdate,o.hn,icd10,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,p.moopart
FROM ovstdiag o
LEFT JOIN patient p ON p.hn = o.hn
WHERE o.vstdate BETWEEN CONCAT('$tyear'-1,'-10-','01') AND  CONCAT('$tyear','-09-','30')
			AND icd10 BETWEEN 'e10' AND 'e149'
			AND p.chwpart='64' AND p.amppart='06' AND p.tmbpart ='01' AND p.moopart IN('3','4','6','8')
GROUP BY o.hn ) AS t1
LEFT JOIN  (SELECT hn,lab_order_result FROM lab_head l LEFT JOIN lab_order d ON d.lab_order_number = l.lab_order_number 
						WHERE lab_items_code='76' AND  order_date BETWEEN CONCAT('$tyear'-1,'-10-','01') AND  CONCAT('$tyear'-1,'-10-','31') ) l10 ON  l10.hn = t1.hn
LEFT JOIN  (SELECT hn,lab_order_result FROM lab_head l LEFT JOIN lab_order d ON d.lab_order_number = l.lab_order_number 
						WHERE lab_items_code='76' AND  order_date BETWEEN CONCAT('$tyear'-1,'-11-','01') AND  CONCAT('$tyear'-1,'-11-','30') ) l11 ON  l11.hn = t1.hn
LEFT JOIN  (SELECT hn,lab_order_result FROM lab_head l LEFT JOIN lab_order d ON d.lab_order_number = l.lab_order_number 
						WHERE lab_items_code='76' AND  order_date BETWEEN CONCAT('$tyear'-1,'-12-','01') AND  CONCAT('$tyear'-1,'-12-','31') ) l12 ON  l12.hn = t1.hn
LEFT JOIN  (SELECT hn,lab_order_result FROM lab_head l LEFT JOIN lab_order d ON d.lab_order_number = l.lab_order_number 
						WHERE lab_items_code='76' AND  order_date BETWEEN CONCAT('$tyear','-01-','01') AND  CONCAT('$tyear','-01-','31') ) l01 ON  l01.hn = t1.hn
LEFT JOIN  (SELECT hn,lab_order_result FROM lab_head l LEFT JOIN lab_order d ON d.lab_order_number = l.lab_order_number 
						WHERE lab_items_code='76' AND  order_date BETWEEN CONCAT('$tyear','-02-','01') AND  CONCAT('$tyear','-02-','29') ) l02 ON  l02.hn = t1.hn
LEFT JOIN  (SELECT hn,lab_order_result FROM lab_head l LEFT JOIN lab_order d ON d.lab_order_number = l.lab_order_number 
						WHERE lab_items_code='76' AND  order_date BETWEEN CONCAT('$tyear','-03-','01') AND  CONCAT('$tyear','-03-','31') ) l03 ON  l03.hn = t1.hn
LEFT JOIN  (SELECT hn,lab_order_result FROM lab_head l LEFT JOIN lab_order d ON d.lab_order_number = l.lab_order_number 
						WHERE lab_items_code='76' AND  order_date BETWEEN CONCAT('$tyear','-04-','01') AND  CONCAT('$tyear','-04-','31') ) l04 ON  l04.hn = t1.hn
LEFT JOIN  (SELECT hn,lab_order_result FROM lab_head l LEFT JOIN lab_order d ON d.lab_order_number = l.lab_order_number 
						WHERE lab_items_code='76' AND  order_date BETWEEN CONCAT('$tyear','-05-','01') AND  CONCAT('$tyear','-05-','30') ) l05 ON  l05.hn = t1.hn
LEFT JOIN  (SELECT hn,lab_order_result FROM lab_head l LEFT JOIN lab_order d ON d.lab_order_number = l.lab_order_number 
						WHERE lab_items_code='76' AND  order_date BETWEEN CONCAT('$tyear','-06-','01') AND  CONCAT('$tyear','-06-','31') ) l06 ON  l06.hn = t1.hn
LEFT JOIN  (SELECT hn,lab_order_result FROM lab_head l LEFT JOIN lab_order d ON d.lab_order_number = l.lab_order_number 
						WHERE lab_items_code='76' AND  order_date BETWEEN CONCAT('$tyear','-07-','01') AND  CONCAT('$tyear','-07-','31') ) l07 ON  l07.hn = t1.hn
LEFT JOIN  (SELECT hn,lab_order_result FROM lab_head l LEFT JOIN lab_order d ON d.lab_order_number = l.lab_order_number 
						WHERE lab_items_code='76' AND  order_date BETWEEN CONCAT('$tyear','-08-','01') AND  CONCAT('$tyear','-08-','31') ) l08 ON  l08.hn = t1.hn
LEFT JOIN  (SELECT hn,lab_order_result FROM lab_head l LEFT JOIN lab_order d ON d.lab_order_number = l.lab_order_number 
						WHERE lab_items_code='76' AND  order_date BETWEEN CONCAT('$tyear','-09-','01') AND  CONCAT('$tyear','-09-','31') ) l09 ON  l09.hn = t1.hn
GROUP BY t1.hn ";
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
        return $this->render('dmin', ['dataProvider' => $dataProvider, 'tyear' => $tyear,'type'=>$type]);
    }

}
