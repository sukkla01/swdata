<?php

namespace frontend\controllers;

class EhController extends \common\components\AppController{

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
        return $this->render('eh001',['dataProvider' => $dataProvider]);
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
        return $this->render('eh002',['dataProvider' => $dataProvider]);
    }

}
