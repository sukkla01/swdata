<?php

namespace app\modules\oapp\controllers;
use kartik\mpdf\Pdf;

class PdfoappController extends \yii\web\Controller
{
    public function actionIndex()
    {
        
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
            'options' => ['title' => 'ใบนัด รพ.ศรีสังวรสุโขทัย '],
            // call mPDF methods on the fly 
            'methods' => [
            //'SetHeader'=>[''], 
            //'SetFooter'=>['{PAGENO}'], 
            ]
        ]);


        return $pdf->render();
    }

}
