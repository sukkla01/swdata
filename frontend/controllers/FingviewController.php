<?php

namespace frontend\controllers;

use Yii;

class FingviewController extends \yii\web\Controller {

    public function actionIndex() {
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
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionDfile() {

        $name = $_GET['file'];

        $path = Yii::getAlias('localhost/swdata/backend/web') . '/fingerfile/';
        $file = $path . $name;

        //$aa = Yii::$app->response->sendFile($file);


        //$path = Yii::getPathOfAlias('webroot') . "/uploads/downloads/23602414.pdf";
        //$this->downloadFile($file);
        $file = Yii::getAlias('@webroot') ;
        return $this->render('dfile',['path'=>$file]);
    }

    public function downloadFile($fullpath) {
        if (!empty($fullpath)) {
            header("Content-type:application/pdf"); //for pdf file
            //header('Content-Type:text/plain; charset=ISO-8859-15');
            //if you want to read text file using text/plain header 
            header('Content-Disposition: attachment; filename="' . basename($fullpath) . '"');
            header('Content-Length: ' . filesize($fullpath));
            readfile($fullpath);
            Yii::app()->end();
        }
    }

}
