<?php

namespace backend\controllers;
use Yii;

class FsettingController extends \yii\web\Controller
{
    public function actionIndex()
    {
        
        return $this->render('index');
    }
    public function actionAddsetting()
    {
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
    public function actionAddcd()
    {
        $addcd = $_GET['addcd'];
        $connection = Yii::$app->db;
        $datalcd = $connection->createCommand("INSERT INTO nur_congenital_disease VALUES (NULL,'$addcd','') ")->execute();
        
        return $datalcd;
        
        
    }

}
