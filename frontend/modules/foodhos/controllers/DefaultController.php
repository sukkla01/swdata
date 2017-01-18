<?php

namespace frontend\modules\foodhos\controllers;

use yii\web\Controller;
use app\models\FoodDetail01;
use Yii;
use kartik\mpdf\Pdf;
use app\models\FoodProcess;
use app\models\FoodProcessOrder;

/**
 * Default controller for the `foodhos` module
 */
class DefaultController extends \common\components\AppController {

    /**
     * Renders the index view for the module
     * 
     * 
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

        $i = '';
        $ward = '';
        if (Yii::$app->request->isPost) {
            $ward = $_POST['ward'];
        }
        if (isset($_GET['ward'])) {
            $ward = $_GET['ward'];
        }
        
        
        
        
        
        return $this->render('index', ['ward' => $ward, 'process' => 'N', 'order_complete' => 'N']);
    }

    public function actionPdf() {
        $this->permitRole([1, 3]);
        //$case_molecular = MolecularTest::findOne(['id_case' => $id_case]);
        // $patient_case = PatientCase::findOne(['id_case' => $id_case]);
        $ward = $_GET['ward'];
        $tan = '';

        $sql = "SELECT f.an,
                COUNT(foodid)  as tcount
                FROM food_detail_01  f
                WHERE f.fooddate=CURDATE() 
                AND f.ward='61'
                GROUP BY an,fooddate
                HAVING tcount >1  ";
        $connection = Yii::$app->db2;
        $data = $connection->createCommand($sql)
                ->queryAll();
        for ($i = 0; $i < sizeof($data); $i++) {
            $tan = $data[$i]['an'];
        }

        if ($tan <> '') {
            
        } else {



            $content = $this->renderPartial('_preview', [
                'ward' => $ward
                    //'patient_case' => $patient_case,
            ]);

            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8,
                // A4 paper format 
                'format' => Pdf::FORMAT_A4,
                'marginLeft' => 10,
                'marginRight' => 10,
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
    }
    
     public function actionTmodal() {
         $tan='';
          $sql = "SELECT f.an,
                COUNT(foodid)  as tcount
                FROM food_detail_01  f
                WHERE f.fooddate=CURDATE() 
                AND f.ward='61'
                GROUP BY an,fooddate
                HAVING tcount >1  ";
        $connection = Yii::$app->db2;
        $data = $connection->createCommand($sql)
                ->queryAll();
        for ($i = 0; $i < sizeof($data); $i++) {
            $tan = $data[$i]['an'];
        }

        if ($tan <> '') {
              return $this->renderAjax('tmodal', []);
        } else {
            
        }
         
         
      
     }

    public function actionOrderold() {

        $connection = Yii::$app->db;
        $ward = $_GET['ward'];
        $c_current = '';


        $sql1 = " SELECT d_last FROM food_process_order WHERE ward='$ward' ";
        $command = Yii::$app->db->createCommand($sql1);
        $c_current = $command->queryScalar();

        $sql2 = " SELECT is_running FROM food_process WHERE ward='$ward' ";
        $command = Yii::$app->db->createCommand($sql2);
        $running = $command->queryScalar();



        if ($c_current == date('Y-m-d')) {
            return $this->render('index', ['ward' => $ward, 'process' => 'N', 'order_complete' => 'Y']);
        } else {


            if ($running == 'false') {

                $this->call("Jub_Order_food", $ward);
                //sleep(10);
                //echo $ward;
                return $this->render('index', ['ward' => $ward, 'process' => 'Y', 'order_complete' => 'N']);
            } else {
                return $this->render('index', ['ward' => $ward, 'process' => 'N', 'order_complete' => 'N']);
            }
        }
    }

}
