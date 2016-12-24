<?php

namespace frontend\controllers;

use Yii;

class ProcessController extends \yii\web\Controller {

    public function actionIndex() {
        $connection = Yii::$app->db2;

        $sql = "SELECT * FROM oppp43.typearea_t limit 1,100000 ";
        $data = $connection->createCommand($sql)
                ->queryAll();

        for ($i = 0; $i < sizeof($data); $i++) {
            $hospcode = $data[$i]['hospcode'];
            $cid = $data[$i]['cid'];
            $type_area = $data[$i]['type_area'];
            
            $sql1 = "UPDATE oppp43.typearea_t SET status='Y' where cid='$cid' ";
            $data1 = $connection->createCommand($sql1)->execute();

        }




        return $this->render('index');
    }

}
