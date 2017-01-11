<?php

namespace frontend\modules\foodh\controllers;

use yii\web\Controller;
use Yii;
use app\models\FoodDetail01;

/**
 * Default controller for the `foodh` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
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
