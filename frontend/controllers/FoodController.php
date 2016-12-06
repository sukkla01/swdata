<?php

namespace frontend\controllers;
use Yii;

class FoodController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function  actionFoodmain(){
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        $tdate = date('Y-m-d H:m:s');
        $dataProvider='';
        $i='';
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
        
        $sql= "SELECT i.hn,i.an,a.bedno,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,
                CONCAT(s.age_y,' ปี ',s.age_m,' เดือน ',s.age_d,' วัน') AS tage,f.fooddate,
                i.regdate,i.regtime,f2.icode,congenital_disease,
                CONCAT(bd,' ',cal,' ',n.name)  AS nname,o.height,o.bw,o.bmi
                FROM ipt i
                LEFT JOIN patient p ON p.hn = i.hn
                LEFT JOIN iptadm a ON a.an = i.an
                LEFT JOIN an_stat s ON s.an = i.an
                LEFT JOIN (SELECT MAX(fooddate) AS fooddate,an FROM food_detail_01 WHERE fooddate=CURDATE() GROUP BY an) AS f ON f.an = i.an
                LEFT JOIN food_detail_01 f2 ON f2.an = f.an AND f2.fooddate = f.fooddate
                LEFT JOIN nutrition_items n ON n.icode = f2.icode
                LEFT JOIN opdscreen o ON o.vn = i.vn
                WHERE i.dchdate IS NULL AND i.ward ='02'";
        
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
        
        
        return $this->render('foodmain',['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2]);
    }

}
