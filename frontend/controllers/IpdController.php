<?php

namespace frontend\controllers;
use Yii;

class IpdController extends \common\components\AppController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
     public function actionM17()
    {
         $this->permitRole([1, 3]);
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
       if (Yii::$app->request->isPost) {
            if (isset($_POST['date1']) == '') {
                $date1 = Yii::$app->session['date1'];
                $date2 = Yii::$app->session['date2'];
            } else {

                $date1 = $_POST['date1'];
                $date2 = $_POST['date2'];
                Yii::$app->session['date1'] = $date1;
                Yii::$app->session['date2'] = $date2;
            }
        }
        
        $sql = "SELECT i.hn,i.an,i.dchdate,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,d.icd10,c.name AS cname,o.icd9,m.name AS 9name,rw,SUM(sum_price) AS tsum ,a.admday
                FROM  ipt i
                LEFT JOIN iptdiag d ON d.an=i.an
                LEFT JOIN iptoprt o ON o.an=i.an
                LEFT JOIN patient p ON p.hn=i.hn
                LEFT JOIN icd101 c ON c.code=d.icd10
                LEFT JOIN icd9cm1 m ON m.code=o.icd9
                INNER JOIN opitemrece t ON t.an=i.an
                LEFT JOIN iptadm a ON a.an=i.an
                WHERE dchdate BETWEEN '$date1' AND '$date2'
                                        AND icd10 BETWEEN 'm17' AND 'm179'
                GROUP BY i.an ";
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
        ]);
        return $this->render('m17',['dataProvider' => $dataProvider,'date1'=>$date1,'date2'=>$date2,'tsql',$tsql]);
    }
    

}