<?php

namespace frontend\controllers;

class TestController extends \yii\web\Controller
{
    public function actionIndex()
    {
         //$this->permitRole([3]);
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
        return $this->render('index',['dataProvider' => $dataProvider]);
    }
    public function actionBk()
    {
        return $this->render('bk');
    }

}
