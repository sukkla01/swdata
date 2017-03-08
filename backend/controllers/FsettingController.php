<?php

namespace backend\controllers;

use Yii;

class FsettingController extends \yii\web\Controller {

    public function actionIndex() {

        $connection = Yii::$app->db;
        
        if (isset($_GET['tstatus']) == 'd') {

            $id = $_GET['id'];

            $datale = $connection->createCommand("DELETE FROM nur_congenital_disease WHERE id = '$id' ")->execute();
        }
        if (isset($_GET['tstatus']) == 'dcal') {
             $id = $_GET['id'];
           
            $datale = $connection->createCommand("DELETE FROM nur_cal WHERE id = '$id' ")->execute();
        }

        return $this->render('index', ['alert' => 0]);
    }

    public function actionAddsetting() {
        $linetoken = $_GET['linetoken'];
        $noti = $_GET['noti'];
        $s_time = $_GET['s_time'];
        $e_time = $_GET['e_time'];
        $s_time = str_replace(':', '.', $s_time);
        $e_time = str_replace(':', '.', $e_time);

        $connection = Yii::$app->db;
        $dataltoken = $connection->createCommand("UPDATE food_setting SET value='$linetoken' WHERE type='line_token' ")->execute();
        $dataln = $connection->createCommand("UPDATE food_setting SET value='$noti' WHERE type='line_noti' ")->execute();
        $datals = $connection->createCommand("UPDATE food_setting SET value='$e_time' WHERE type='e_time_line' ")->execute();
        $datale = $connection->createCommand("UPDATE food_setting SET value='$s_time' WHERE type='s_time_line' ")->execute();

        return $dataln;
    }

    public function actionAddcd() {
        $addcd = $_GET['addcd'];
        $connection = Yii::$app->db;
        $datalcd = $connection->createCommand("INSERT INTO nur_congenital_disease VALUES (NULL,'$addcd','$addcd') ")->execute();

        return $datalcd;
    }
    
     public function actionAddcal() {
        $addcal = $_GET['addcal'];
        $connection = Yii::$app->db;
        $datalcd = $connection->createCommand("INSERT INTO nur_cal VALUES (NULL,'$addcal','$addcal') ")->execute();

        return $datalcd;
    }

}
