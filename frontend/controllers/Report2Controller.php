<?php

namespace frontend\controllers;

use Yii;

class Report2Controller extends \common\components\AppController {

    public function actionIndex() {
        $this->permitRole([1, 3]);
        return $this->render('index');
    }
    
    public function actionReport1() {
        $this->permitRole([1, 3]);
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        
        if (isset($_GET['page'])) {
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];
        }
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
        if (isset($_GET['date1'])) {
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];
        }

        $sql = " SELECT  i.regdate,IF(i.dchdate IS NULL,'',i.dchdate) AS dchdate,i.hn,i.an,CONCAT(p.pname,p.fname,' ',p.lname)  AS	tname,
				w.name 	AS wname,a.pdx
                    FROM  ipt i
                    LEFT JOIN patient p ON p.hn = i.hn
                    LEFT JOIN	ward w ON w.ward = i.ward
                    LEFT JOIN an_stat a ON a.an = i.an
                    LEFT JOIN ovst o ON o.an = i.an
                    WHERE i.regdate BETWEEN '$date1' and '$date2' AND o.spclty='06'
                    ORDER BY	 i.ward ";
                            try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 100
            ],
        ]);
        return $this->render('report1', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2]);
    }

   

}
