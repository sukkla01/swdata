<?php

namespace app\modules\oapp\controllers;
use Yii;

class DetailoappController extends \common\components\AppController 
{
    public function actionIndex()
    {
        $this->permitRole([1, 3]);
        $date1 = date('Y-m-d');
        if (isset($_GET['page'])) {
            $date1 = Yii::$app->session['date1'];
        }
        if (Yii::$app->request->isPost) {
            if (isset($_POST['date1']) == '') {
                $date1 = Yii::$app->session['date1'];
            } else {

                $date1 = $_POST['date1'];
                Yii::$app->session['date1'] = $date1;
            }
        }
        if (isset($_GET['date1'])) {
            $date1 = Yii::$app->session['date1'];
        }
        
        $sql="SELECT * FROM oapp_event  where created_date ='$date1' order by id desc";
        try {
            $rawData = \Yii::$app->db5->createCommand($sql)->queryAll();
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
        
        
        return $this->render('index',['dataProvider' => $dataProvider,'date1'=>$date1]);
    }

}
