<?php

namespace frontend\controllers;

class FingviewController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $tsql = "SELECT year,name,file1,file2,file3,file4,note1
                FROM finger_download d
                LEFT JOIN finger_month m ON m.code = d.month
                ORDER BY d.year,d.month  DESC";

        try {
            $rawData = \Yii::$app->db->createCommand($tsql)->queryAll();
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
        return $this->render('index',['dataProvider' => $dataProvider]);
    }

}
