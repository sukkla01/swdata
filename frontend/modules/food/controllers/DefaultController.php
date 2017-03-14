<?php

namespace frontend\modules\food\controllers;

use yii\web\Controller;
use Yii;
use app\models\FoodDetail01;
use kartik\mpdf\Pdf;

/**
 * Default controller for the `food` module
 */
class DefaultController extends \common\components\AppController  {

    /**
     * Renders the index view for the module
     * @return string
     */
    
     protected function call($store_name, $arg = NULL) {
        $sql = "";
        if ($arg != NULL) {
            $sql = "call " . $store_name . "(" . $arg . ");";
        } else {
            $sql = "call " . $store_name . "();";
        }
        $this->exec_sql($sql);
    }
    
     protected function exec_sql($sql) {
        $affect_row = \Yii::$app->db2->createCommand($sql)->execute();
        return $affect_row;
    }

    
    public function actionIndex() {
        $this->permitRole([1, 3]);
        $connection = Yii::$app->db2;
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        $tdate = date('Y-m-d H:m:s');
        $dataProvider[] = '';
        $i = '';
        $ward = '';
        $tstatus = '';

        if (isset($_GET['ward']) and $_GET['modal'] == 1) {
            $ward = $_GET['ward'];
            if (strlen($ward) == 1) {
                $ward = '0' . $ward;
            }
        }
        if (Yii::$app->request->isPost) {
            $ward = $_POST['ward'];
        }


        /// -------------- delete -------------------
        if (isset($_GET['foodid']) and ( $_GET['tstatus']) == 'd') {
            $foodid = $_GET['foodid'];
            $anl = $_GET['an'];
            $hnl = $_GET['hn'];
            $icodel = $_GET['icode'];
            $icode = '';
            $fooddate = '';
            $foodtime = '';
            $Congenital_disease = '';
            $usern = Yii::$app->user->identity->username;
            $data1 = $connection->createCommand("DELETE FROM food_detail_01 WHERE foodid = '$foodid' ")->execute();
            $data2 = $connection->createCommand(" INSERT INTO food_log_01 VALUES (NULL,CURDATE(),CURTIME(),'delete','$icodel','$anl','$hnl','','$usern') ")->execute();
            $sqld = "SELECT icode,fooddate,foodtime,Congenital_disease
                    FROM food_detail_01 
                    WHERE an='$anl'
                    ORDER BY foodid DESC
                    LIMIT 1";
            $datad = $connection->createCommand($sqld)
                    ->queryAll();
            for ($i1 = 0; $i1 < sizeof($datad); $i1++) {
                $icode = $datad[$i1]['icode'];
                $fooddate = $datad[$i1]['fooddate'];
                $foodtime = $datad[$i1]['foodtime'];
                $Congenital_disease = $datad[$i1]['Congenital_disease'];
            }
            if($fooddate==''){
              $data3 = $connection->createCommand("UPDATE swdata.food_last SET  icode=null,fooddate_last=null,foodtime=null,Congenital_disease=null  WHERE an ='$anl' ")->execute();  
            }else {
              $data3 = $connection->createCommand("UPDATE swdata.food_last SET  icode='$icode',fooddate_last='$fooddate',foodtime='$foodtime',Congenital_disease='$Congenital_disease'  WHERE an ='$anl' ")->execute();  
            }
            
        }


        $sql = "SELECT i.hn,i.an,a.bedno,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,
                CONCAT(s.age_y,' ปี ',s.age_m,' เดือน ',s.age_d,' วัน') AS tage,f.fooddate_last as fooddate,f.foodtime,
                i.regdate,i.regtime,f.icode,i.ward,
                n.name  AS nname,f.dis,
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
                WHERE i.dchdate IS NULL AND i.ward ='$ward' 
                ORDER BY bedno  ";


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
            return $this->render('index', ['dataProvider' => $dataProvider, 'ward' => $ward, 'process' => 'N', 'order_complete' => 'N','modal'=>0]);
        }
    }

    public function actionPdf() {
        //$//this->permitRole([1, 3]);
        //$case_molecular = MolecularTest::findOne(['id_case' => $id_case]);
        // $patient_case = PatientCase::findOne(['id_case' => $id_case]);
        $ward = $_GET['ward'];
        $tan = '';





        $content = $this->renderPartial('_preview', [
            'ward' => $ward
                //'patient_case' => $patient_case,
        ]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format 
            'format' => Pdf::FORMAT_A4,
            'marginLeft' => 5,
            'marginRight' => 5,
            'marginTop' => 1,
            'marginBottom' => false,
            'marginHeader' => false,
            'marginFooter' => false,
            // portrait orientation 
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            // stream to browser inline 
            'destination' => Pdf::DEST_BROWSER,
            // your html content input 
            'content' => $content,
            // format content from your own css file if needed or use the 
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@frontend/web/css/pdf.css',
            // any css to be embedded if required 
            'cssInline' => '.bd{border:1.5px solid; text-align: center;} .ar{text-align:right} .imgbd{border:1px solid}',
            // set mPDF properties on the fly 
            'options' => ['title' => 'ใบสั่งอาหาร รพ.ศรีสังวรสุโขทัย '],
            // call mPDF methods on the fly 
            'methods' => [
            //'SetHeader'=>[''], 
            //'SetFooter'=>['{PAGENO}'], 
            ]
        ]);


        return $pdf->render();
    }
    
    public function actionPdftotal() {
        //$//this->permitRole([1, 3]);
        //$case_molecular = MolecularTest::findOne(['id_case' => $id_case]);
        // $patient_case = PatientCase::findOne(['id_case' => $id_case]);
        $ward = $_GET['ward'];
        $tan = '';





        $content = $this->renderPartial('_totalprint', [
            'ward' => $ward
                //'patient_case' => $patient_case,
        ]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format 
            'format' => Pdf::FORMAT_A4,
            'marginLeft' => 5,
            'marginRight' => 5,
            'marginTop' => 1,
            'marginBottom' => false,
            'marginHeader' => false,
            'marginFooter' => false,
            // portrait orientation 
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline 
            'destination' => Pdf::DEST_BROWSER,
            // your html content input 
            'content' => $content,
            // format content from your own css file if needed or use the 
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@frontend/web/css/pdf.css',
            // any css to be embedded if required 
            'cssInline' => '.bd{border:1.5px solid; text-align: center;} .ar{text-align:right} .imgbd{border:1px solid}',
            // set mPDF properties on the fly 
            'options' => ['title' => 'ใบสรุปการเพิ่มอาหารหรือการเปลี่ยนอาหารรายวัน รพ.ศรีสังวรสุโขทัย '],
            // call mPDF methods on the fly 
            'methods' => [
            //'SetHeader'=>[''], 
            //'SetFooter'=>['{PAGENO}'], 
            ]
        ]);


        return $pdf->render();
    }

    public function actionTest() {
        $this->permitRole([1, 3]);
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

    public function actionOrderold() {
        $this->permitRole([1, 3]);
        $connection = Yii::$app->db;
        $ward = $_GET['ward'];
        $c_current = '';


        $sql1 = " SELECT d_last FROM food_process_order WHERE ward='$ward' ";
        $command = Yii::$app->db->createCommand($sql1);
        $c_current = $command->queryScalar();

        $sql2 = " SELECT is_running FROM food_process WHERE ward='$ward' ";
        $command = Yii::$app->db->createCommand($sql2);
        $running = $command->queryScalar();


        $sql = "SELECT i.hn,i.an,a.bedno,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,
                CONCAT(s.age_y,' ปี ',s.age_m,' เดือน ',s.age_d,' วัน') AS tage,f.fooddate_last as fooddate,f.foodtime,
                i.regdate,i.regtime,f.icode,i.ward,
                n.name  AS nname,f.dis,
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
                WHERE i.dchdate IS NULL AND i.ward ='$ward' 
                ORDER BY bedno  ";


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



        if ($c_current == date('Y-m-d')) {
            return $this->render('index', ['ward' => $ward, 'process' => 'N', 'order_complete' => 'Y', 'dataProvider' => $dataProvider,'modal'=>0]);
        } else {


            if ($running == 'false') {
                $staff = Yii::$app->user->identity->username;
                $this->call("Jub_Order_food", "$ward");
                //sleep(10);
                //echo $ward;
                return $this->render('index', ['ward' => $ward, 'process' => 'Y', 'order_complete' => 'N', 'dataProvider' => $dataProvider,'modal'=>0]);
            } else {
                return $this->render('index', ['ward' => $ward, 'process' => 'N', 'order_complete' => 'N', 'dataProvider' => $dataProvider,'modal'=>0]);
            }
        }
    }

}
