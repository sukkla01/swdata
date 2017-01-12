<?php

namespace frontend\modules\foodhos\controllers;

use yii\web\Controller;
use app\models\FoodDetail01;
use Yii;
use kartik\mpdf\Pdf;
/**
 * Default controller for the `foodhos` module
 */
class DefaultController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        $i = '';
        $ward = '';
        if (Yii::$app->request->isPost) {
            $ward = $_POST['ward'];
        }
        if (isset($_GET['ward'])) {
            $ward = $_GET['ward'];
        }
        return $this->render('index', ['ward' => $ward]);
    }

    public function actionPdf() {
        //$case_molecular = MolecularTest::findOne(['id_case' => $id_case]);
       // $patient_case = PatientCase::findOne(['id_case' => $id_case]);
        $ward = $_GET['ward'];
        $content = $this->renderPartial('_preview', [
            'ward' => $ward
            //'patient_case' => $patient_case,
        ]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format 
            'format' => Pdf::FORMAT_A4,
            'marginLeft' => 10, 
            'marginRight' =>10, 
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
