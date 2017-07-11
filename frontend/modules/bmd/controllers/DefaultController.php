<?php

namespace frontend\modules\bmd\controllers;

use yii\web\Controller;
use Yii;
/**
 * Default controller for the `bmd` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
        }
        if (isset($_GET['date1'])) {
             $date1 = $_GET['date1'];
            $date2 = $_GET['date2'];
        }
        $sql = "SELECT o.hn,o.vstdate,o.vn,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,v.age_y,v.pdx,
                IF(b.vn IS NULL,'N','Y') AS tck,IF(b.l1l4 IS NULL,'',b.l1l4) AS l1l4,'$date1' as date1,'$date2' as date2,
                IF(b.neck_lt IS NULL,'',b.neck_lt) AS neck_lt,
                IF(b.neck_rt IS NULL,'',b.neck_rt) AS neck_rt,
                IF(b.troch_lt IS NULL,'',b.troch_lt) AS troch_lt,
                IF(b.troch_rt IS NULL,'',b.troch_rt) AS troch_rt,
                CONCAT(o.pttype,' ',pt.name) ptname,if(b.id is null,0,b.id) as id
                FROM opitemrece o
                LEFT JOIN vn_stat v ON v.vn=o.vn
                LEFT JOIN patient p ON p.hn = o.hn
                LEFT JOIN pttype pt ON pt.pttype = o.pttype
                LEFT JOIN swdata.bonemass b ON b.vn = o.vn
                WHERE o.vstdate BETWEEN '$date1' AND '$date2'
                                        AND o.icode = '3004201'";

        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
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
        return $this->render('index', ['dataProvider' => $dataProvider,'date1'=>$date1,'date2'=>$date2]);
    }
    
    
    public function actionDelbmd()
    {
        $id = $_GET['id'];
        $sql = "DELETE FROM swdata.bonemass WHERE id='$id' ";
        $connection = Yii::$app->db;
        $usern = Yii::$app->user->identity->username;
        $datals = $connection->createCommand($sql)->execute();

        return $datals;
        
    }
}
