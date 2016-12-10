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

       // $path = Yii::getAlias('localhost/swdata/backend/web') . '/fingerfile/';
       // $file = $path . $name;

        //$aa = Yii::$app->response->sendFile($file);
        
        $pathFile = 'D:/xampp/htdocs/swdata/backend/web/fingerfile/'.$name;

        $pathFile1 = Yii::getAlias('@webroot').'/fingerfile/012559_1.pdf' ;
       //  $filename = '012559_1.pdf';
        //$path = Yii::getPathOfAlias('webroot') . "/uploads/downloads/23602414.pdf";
       // $this->downloadFile($file);
       //  return $this->render('dfile', ['path' => $pathFile,'path1'=>$pathFile1]);
        //return  Yii::$app->response->sendFile($path, $filename);
       return \Yii::$app->response->sendFile($pathFile);

    }

   

}
