<?php

namespace frontend\modules\foodh\controllers;

use yii\web\Controller;
use Yii;
use app\models\FoodDetail01;

/**
 * Default controller for the `foodh` module
 */
class DefaultController extends \common\components\AppController 
{
    
    public function actionIndex()
    {
        $this->permitRole([1, 3]);
        $i = '';
        $ward='';
        if (Yii::$app->request->isPost) {
            $ward = $_POST['ward'];
        }
        
        return $this->render('index',['ward'=>$ward]);
    }
    
    public function actionFoodadd()
    {
        $model = new FoodDetail01();
        
    }
}
