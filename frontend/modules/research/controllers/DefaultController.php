<?php

namespace app\modules\research\controllers;

use yii\web\Controller;
use kartik\mpdf\Pdf;

/**
 * Default controller for the `research` module
 */
class DefaultController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        $sql = "SELECT * FROM research";

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
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
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionPdf() {
       
       if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        
        
        
        
        
        
        
        $content = $this->renderPartial('_preview', [
            'id' =>$id
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
            'options' => ['title' => 'งานวิจัย'],
            // call mPDF methods on the fly 
            'methods' => [
            //'SetHeader'=>[''], 
            //'SetFooter'=>['{PAGENO}'], 
            ]
        ]);


        return $pdf->render();
    }

}
