<?php

namespace frontend\controllers;

use Yii;

class EhController extends \common\components\AppController {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionEh001() {
        $this->permitRole([1, 3]);
        $sql = "SELECT p.hn,IF(p.cid IS NULL,'',p.cid) AS cid,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,CONCAT(p.addrpart,' หมู่ ',p.moopart,' ',t.full_name) AS taddr,
                p.moopart,p.tmbpart,p.amppart,p.chwpart,
                if(p.sex =1,'Y','N') as color
                FROM patient p
                LEFT JOIN person ps ON ps.patient_hn=p.hn
                LEFT JOIN thaiaddress t ON t.chwpart=p.chwpart AND t.amppart=p.amppart AND t.tmbpart=p.tmbpart
                WHERE type_area IN('1','3') AND ps.cid IS NULL and p.last_visit < '2006-08-01'";
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        
         for ($i = 0; $i < sizeof($rawData); $i++) {
            $color[] = $rawData[$i]['color'] ;
            //$m2[] = $data[$i]['m2'] * 1;
        }
        
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'sort' => [
                'attributes' => [
                    'cid',
                    'hn',
                    'tname'
                    
                ],
            ],
            'pagination' => [
                'pageSize' => 20
            ],
                //'pagination' => FALSE,
        ]);
        return $this->render('eh001', ['dataProvider' => $dataProvider,'color'=>$color]);
    }

    public function actionEh002() {
        $this->permitRole([1, 3]);
        $sql = "SELECT IF(p.patient_hn IS NULL,'',p.patient_hn) AS hn,p.cid,CONCAT(p.pname,p.fname,' ',p.lname) AS tname
                FROM person p
                WHERE house_regist_type_id IS NULL";
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
                //'pagination' => FALSE,
        ]);
        return $this->render('eh002', ['dataProvider' => $dataProvider]);
    }

    public function actionEh003() {
        $this->permitRole([1, 3]);
        $sql = "SELECT IF(p.patient_hn IS NULL,'',p.patient_hn) AS hn,p.cid,CONCAT(p.pname,p.fname,' ',p.lname) AS tname
                FROM person p
                WHERE person_house_position_id IS NULL";
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
                //'pagination' => FALSE,
        ]);
        return $this->render('eh003', ['dataProvider' => $dataProvider]);
    }

    public function actionEh004() {
        $this->permitRole([1, 3]);
        $sql = "SELECT IF(p.patient_hn IS NULL,'',p.patient_hn) AS hn,p.cid,CONCAT(p.pname,p.fname,' ',p.lname) AS tname
                FROM person p
                WHERE education IS NULL";
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
                //'pagination' => FALSE,
        ]);
        return $this->render('eh004', ['dataProvider' => $dataProvider]);
    }

    public function actionEh005() {
        $this->permitRole([1, 3]);
        $sql = "SELECT IF(p.patient_hn IS NULL,'',p.patient_hn) AS hn,p.cid,CONCAT(p.pname,p.fname,' ',p.lname) AS tname
                FROM person p
                WHERE Year(CURDATE())-YEAR(birthdate) BETWEEN '6' AND '12'
			AND education <>'1'";
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
                //'pagination' => FALSE,
        ]);
        return $this->render('eh005', ['dataProvider' => $dataProvider]);
    }

    public function actionEh006() {
        $this->permitRole([1, 3]);
        $sql = "SELECT IF(p.patient_hn IS NULL,'',p.patient_hn) AS hn,p.cid,CONCAT(p.pname,p.fname,' ',p.lname) AS tname
                FROM person p
                WHERE occupation IS NULL";
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
                //'pagination' => FALSE,
        ]);
        return $this->render('eh006', ['dataProvider' => $dataProvider]);
    }

    public function actionEh007() {
        $this->permitRole([1, 3]);
        $sql = "SELECT IF(p.patient_hn IS NULL,'',p.patient_hn) AS hn,p.cid,CONCAT(p.pname,p.fname,' ',p.lname) AS tname
                FROM person p
                WHERE pname IS NULL";
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
                //'pagination' => FALSE,
        ]);
        return $this->render('eh007', ['dataProvider' => $dataProvider]);
    }

    public function actionEh008() {
        $this->permitRole([1, 3]);
        $sql = "SELECT IF(p.patient_hn IS NULL,'',p.patient_hn) AS hn,p.cid,CONCAT(p.pname,p.fname,' ',p.lname) AS tname
                FROM person p
                WHERE (pname IN('ด.ช.','นาย','พระ','พระครู') AND sex ='2') OR (pname IN('ด.ญ.','น.ส.','นาง') AND sex ='1')";
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
                //'pagination' => FALSE,
        ]);
        return $this->render('eh008', ['dataProvider' => $dataProvider]);
    }

    public function actionEh009() {
        $this->permitRole([1, 3]);
        $sql = "SELECT IF(p.patient_hn IS NULL,'',p.patient_hn) AS hn,p.cid,CONCAT(p.pname,p.fname,' ',p.lname) AS tname
                FROM person p
                WHERE (pttype IS NULL OR pttype='')";
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
                //'pagination' => FALSE,
        ]);
        return $this->render('eh009', ['dataProvider' => $dataProvider]);
    }

    public function actionEh010() {
        $this->permitRole([1, 3]);
        $sql = "SELECT IF(p.patient_hn IS NULL,'',p.patient_hn) AS hn,p.cid,CONCAT(p.pname,p.fname,' ',p.lname) AS tname
                FROM person p
                WHERE  death ='Y' AND person_discharge_id='9'";
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
                //'pagination' => FALSE,
        ]);
        return $this->render('eh010', ['dataProvider' => $dataProvider]);
    }

    public function actionEh011() {
        $this->permitRole([1, 3]);
        $sql = "SELECT IF(p.patient_hn IS NULL,'',p.patient_hn) AS hn,p.cid,CONCAT(p.pname,p.fname,' ',p.lname) AS tname
                FROM person p
                WHERE  death ='Y' AND (discharge_date IS NULL OR discharge_date ='')";
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
                //'pagination' => FALSE,
        ]);
        return $this->render('eh011', ['dataProvider' => $dataProvider]);
    }

    public function actionEh012() {
        $this->permitRole([1, 3]);
        $sql = "SELECT IF(p.patient_hn IS NULL,'',p.patient_hn) AS hn,p.cid,CONCAT(p.pname,p.fname,' ',p.lname) AS tname
                FROM person p
                WHERE house_regist_type_id IN('1','3') AND nationality='99' AND cid LIKE '0%'";
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
                //'pagination' => FALSE,
        ]);
        return $this->render('eh012', ['dataProvider' => $dataProvider]);
    }

    public function actionEh013() {
        $this->permitRole([1, 3]);
        $sql = "SELECT IF(p.patient_hn IS NULL,'',p.patient_hn) AS hn,p.cid,CONCAT(p.pname,p.fname,' ',p.lname) AS tname
                FROM person p
                WHERE (YEAR(CURDATE())-YEAR(birthdate)) > 100";
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
                //'pagination' => FALSE,
        ]);
        return $this->render('eh013', ['dataProvider' => $dataProvider]);
    }

    public function actionEh014() {
        $this->permitRole([1, 3]);
        $sql = "SELECT IF(p.patient_hn IS NULL,'',p.patient_hn) AS hn,p.cid,CONCAT(p.pname,p.fname,' ',p.lname) AS tname
                FROM person p
                WHERE house_regist_type_id IN('1','3') AND nationality<>'99'";
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
                //'pagination' => FALSE,
        ]);
        return $this->render('eh014', ['dataProvider' => $dataProvider]);
    }

    //-------------- eh20x --------------------------------
    public function actionEh201() {
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
SELECT o.hn,CONCAT(p.pname,p.fname,' ',p.lname)  AS tname,CONCAT(p.addrpart,' หมู่ ',p.moopart,' ',t.full_name) AS taddr,
p.moopart,p.tmbpart,p.amppart,p.chwpart,IF(icd10 BETWEEN 'e14' AND 'e149','DM','HT') AS type
FROM ovstdiag o
LEFT JOIN clinicmember c ON c.hn=o.hn AND clinic IN('013','029')
LEFT JOIN patient p ON p.hn=o.hn
LEFT JOIN thaiaddress t ON t.chwpart=p.chwpart AND t.amppart=p.amppart AND t.tmbpart=p.tmbpart
WHERE vstdate BETWEEN '$date1' AND '$date2'
			AND (icd10 BETWEEN 'e14' AND 'e149' OR icd10 BETWEEN 'i10' AND 'i15')
			AND c.hn IS NULL
GROUP BY o.hn
UNION ALL
SELECT i.hn,CONCAT(p.pname,p.fname,' ',p.lname)  AS tname,CONCAT(p.addrpart,' หมู่ ',p.moopart,' ',t.full_name) AS taddr,
p.moopart,p.tmbpart,p.amppart,p.chwpart,IF(icd10 BETWEEN 'e14' AND 'e149','DM','HT') AS type
FROM ipt i
LEFT JOIN iptdiag d ON d.an=i.an
LEFT JOIN clinicmember c ON c.hn=i.hn AND clinic IN('013','029')
LEFT JOIN patient p ON p.hn=i.hn
LEFT JOIN thaiaddress t ON t.chwpart=p.chwpart AND t.amppart=p.amppart AND t.tmbpart=p.tmbpart
WHERE i.dchdate BETWEEN '$date1' AND '$date2'
			AND (icd10 BETWEEN 'e14' AND 'e149' OR icd10 BETWEEN 'i10' AND 'i15')
			AND c.hn IS NULL
GROUP BY i.hn ) AS tt
GROUP BY hn";
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
                //'pagination' => FALSE,
        ]);
        return $this->render('eh201', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2]);
    }
    
    public function actionEh202() {
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

        $sql = "select (ph.screen_date),concat(p.pname,p.fname,'  ',p.lname) as name,  p.cid,p.birthdate,ph.age_y,concat(h.address,'  ','หมูู่',v.village_moo,'  ',t.full_name) as address, 
 IF(ps.person_dm_screen_status_id=1 or ps.person_dm_screen_status_id is null, 'N', 'Y') as dm, 
 IF(ps.person_ht_screen_status_id<3 or ps.person_ht_screen_status_id is null, 'N', 'Y') as ht, 
 IF(ps.person_stroke_screen_status_id=1 or ps.person_stroke_screen_status_id is null, 'N', 'Y') as stroke, 
 IF(ps.person_obesity_screen_status_id=1 or ps.person_obesity_screen_status_id is null, 'N', 'Y') as obesity 
 from person_dmht_risk_screen_head ph 
 left outer join person_dmht_screen_summary ps on ps. person_dmht_screen_summary_id=ph.person_dmht_screen_summary_id   
 left outer join person p on ps.person_id=p.person_id  
left outer join house h on p.house_id=h.house_id  
left outer join village v on h.village_id=v.village_id  
left outer join thaiaddress t on v.address_id=t.addressid  
where ps.status_active='Y'  and ps.bdg_year=2559 and
(p.birthdate between '1865-10-01' and '2015-10-01') and ph.screen_date BETWEEN '2015-10-01' and '2016-09-30'  
GROUP BY p.cid";
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
        return $this->render('eh202', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2, 'sql', $sql]);
    }

}
