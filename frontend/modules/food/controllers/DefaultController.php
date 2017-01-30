<?php

namespace frontend\modules\food\controllers;

use yii\web\Controller;

use Yii;
use app\models\FoodDetail01;

/**
 * Default controller for the `food` module
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
        $tdate = date('Y-m-d H:m:s');
        $dataProvider[] = '';
        $i = '';
        $ward='';

        if (Yii::$app->request->isPost) {
            $ward = $_POST['ward'];
        }

            $sql = "SELECT i.hn,i.an,a.bedno,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,
                CONCAT(s.age_y,' ปี ',s.age_m,' เดือน ',s.age_d,' วัน') AS tage,f.fooddate_last as fooddate,
                i.regdate,i.regtime,f.icode,
                n.name  AS nname,
                IF(congenital_disease IS NULL,'',congenital_disease) AS congenital_disease,
		IF(o.height IS NULL,'',o.height) AS height,
		IF(o.bw IS NULL,'',o.bw) AS bw,
		IF(o.bmi IS NULL,'',o.bmi) AS bmi
                FROM ipt i
                LEFT JOIN patient p ON p.hn = i.hn
                LEFT JOIN iptadm a ON a.an = i.an
                LEFT JOIN an_stat s ON s.an = i.an
                LEFT JOIN swdata.food_last f ON f.an = i.an
                LEFT JOIN nutrition_items n ON n.icode = f.icode
                LEFT JOIN opdscreen o ON o.vn = i.vn
                WHERE i.dchdate IS NULL AND i.ward ='$ward'  ";

           
        
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
            return $this->render('index', ['dataProvider' => $dataProvider,'ward'=>$ward]);
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
