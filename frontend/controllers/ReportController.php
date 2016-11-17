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

        $sql = "select distinct(a.an),a.hn,concat(p.pname,p.fname,' ',p.lname) as PatientName,ia.admday,i.adjrw,ds.name as dchstts,dt.name as dchtype,max(idl.ipt_diagnosis_log_date) as datemodify,
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
                group by a.an";
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
        return $this->render('mrs001', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2]);
    }

    public function actionMrs002() {
        $this->permitRole([1, 3]);
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
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
        $sql = "SELECT t.hn,p.cid,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,
                death_diag_1,death_diag_2,death_diag_3,death_diag_4,
                IF(tsum=1,death_diag_1,IF(tsum=3,death_diag_2,IF(tsum=6,death_diag_3,death_diag_4))) AS cdeath
                FROM (
                SELECT hn,cid,death_diag_1,death_diag_2,death_diag_3,death_diag_4,
                (IF(death_diag_1 <>'',1,0 ) + IF(death_diag_2 <>'',2,0 ) +
                IF(death_diag_3 <>'',3,0 ) +
                IF(death_diag_4 <>'',4,0 )) AS tsum 
                FROM death 
                WHERE death_date BETWEEN '$date1' and '$date2' ) AS t
                LEFT JOIN patient p ON p.hn=t.hn
                HAVING  (cdeath BETWEEN 'r00' AND 'r99' OR cdeath BETWEEN 'y10' AND 'y34' 
                        OR cdeath IN('c80','c97','i472','i490','i46','i50','i514','i515','i516','i519','i709'))";
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
    public function actionDrugning() {
        $this->permitRole([1, 3]);
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
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
			AND drugcategory IN('arv','NON-ANTIRETROVIRAL','ANTIVIRAL DRUGS','ANTI-TUBERCULOSIS',
                                            'ANTI-MALARIAL DRUGS','ANTIINFECTIVE','ANTIBACTERIALS AND EYE WASH SOLUTION',
                                            'ANTIBACTERIALS WITH CORTICOSTEROIDS','')
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
                'pageSize' => 20000
            ],
        ]);
        return $this->render('drugning', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2, 'sql', $sql]);
    }

}
