<?php

namespace frontend\controllers;

class DmhtController extends \common\components\AppController {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionDm() {
        $this->permitRole([1,3]);
        $sql = "SELECT * 
                FROM tmp_dmht
                WHERE typeicd='dm' 
                ORDER BY chwpart,amppart,tmbpart,moopart";
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('dm',['dataProvider' => $dataProvider]);
    }
     public function actionHt() {
         $this->permitRole([3]);
        $sql = "SELECT * 
                FROM tmp_dmht
                WHERE typeicd='ht'
                 ORDER BY chwpart,amppart,tmbpart,moopart ";
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('ht',['dataProvider' => $dataProvider]);
    }
     public function actionDmht() {
         $this->permitRole([3]);
        $sql = "SELECT * 
                FROM tmp_dmht
                WHERE typeicd='dmht'
                 ORDER BY chwpart,amppart,tmbpart,moopart";
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('dmht',['dataProvider' => $dataProvider]);
    }

}
