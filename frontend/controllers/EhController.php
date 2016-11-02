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
                p.moopart,p.tmbpart,p.amppart,p.chwpart
                FROM patient p
                LEFT JOIN person ps ON ps.patient_hn=p.hn
                LEFT JOIN thaiaddress t ON t.chwpart=p.chwpart AND t.amppart=p.amppart AND t.tmbpart=p.tmbpart
                WHERE type_area IN('1','3') AND ps.cid IS NULL";
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
        return $this->render('eh001', ['dataProvider' => $dataProvider]);
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

    //-------------- eh20x --------------------------------
    public function actionEh201() {
        $this->permitRole([1, 3]);

        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        if (Yii::$app->request->isPost) {

            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
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
        return $this->render('eh201', ['dataProvider' => $dataProvider,'date1'=>$date1,'date2'=>$date2]);
    }

}
