<?php

namespace frontend\controllers;

use Yii;
use app\models\FoodDetail01;

class FoodController extends \yii\web\Controller {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionFoodmain() {
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        $tdate = date('Y-m-d H:m:s');
        $dataProvider[] = '';
        $i = '';
        $ward='';

        if (Yii::$app->request->isPost) {
            $ward = $_POST['ward'];
            $sql = "SELECT i.hn,i.an,a.bedno,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,
                CONCAT(s.age_y,' ปี ',s.age_m,' เดือน ',s.age_d,' วัน') AS tage,f.fooddate,
                i.regdate,i.regtime,f2.icode,congenital_disease,
                CONCAT(bd,' ',cal,' ',n.name)  AS nname,o.height,o.bw,o.bmi
                FROM ipt i
                LEFT JOIN patient p ON p.hn = i.hn
                LEFT JOIN iptadm a ON a.an = i.an
                LEFT JOIN an_stat s ON s.an = i.an
                LEFT JOIN (SELECT MAX(fooddate) AS fooddate,an FROM food_detail_01 WHERE an > 590000001 GROUP BY an) AS f ON f.an = i.an
                LEFT JOIN food_detail_01 f2 ON f2.an = f.an AND f2.fooddate = f.fooddate
                LEFT JOIN nutrition_items n ON n.icode = f2.icode
                LEFT JOIN opdscreen o ON o.vn = i.vn
                WHERE i.dchdate IS NULL AND i.ward ='$ward' ";

           
        }else {
            $sql="select 1 as cc,'' as fooddate,'' as an,'' as bedno";
        }

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




        $model = new FoodDetail01();
        if (\Yii::$app->getRequest()->isAjax) {
            return $this->renderAjax('test', ['model' => $model,]);
        } else {
            return $this->render('foodmain', ['dataProvider' => $dataProvider,'ward'=>$ward]);
        }
    }

    public function actionFoodone() {
        $model = new Foodone();

        return $this->renderAjax('foodone', [
                    'model' => $model,
        ]);
    }

    public function actionCreate() {

        if (Yii::$app->getRequest()->isAjax) {
            return $this->renderAjax('create'
            );
        } else {
            return $this->render('create');
        }
    }

    public function actionTest() {
        //$id= $_GET['id'];
        $model = new FoodDetail01();
        $an = '';
        $an = $_GET['an'];
        $bed = $_GET['bed'];
        $tname = '';
        $hn = '';
        $ptname = '';
        $aa = 0;
        $sql = "select i.an,i.hn,CONCAT(p.pname,p.fname,' ',p.lname)  AS tname,
                t.name AS ptname,i.ward
                from  ipt i
                LEFT JOIN patient p ON p.hn=i.hn
                LEFT JOIN pttype t ON t.pttype = i.pttype
                WHERE an='$an' ";
        $connection = Yii::$app->db2;
        $data = $connection->createCommand($sql)
                ->queryAll();

        for ($i = 0; $i < sizeof($data); $i++) {
            $tname = $data[$i]['tname'];
            $hn = $data[$i]['hn'];
            $ptname = $data[$i]['ptname'];
            $ward = $data[$i]['ward'];
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            return $this->renderAjax('test', ['model' => $model,
                        'an' => $an, 'bed' => $bed, 'tname' => $tname,
                        'hn' => $hn, 'ptname' => $ptname, 'ward' => $ward]);
        }
    }

}
