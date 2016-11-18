<?php

namespace backend\controllers;

class TestController extends \common\components\AppController
{
    public function actionIndex()
    {
       
        return $this->render('index');
    }
     public function actionTest()
    {
         $this->permitRole([1]);
        return $this->render('test');
    }


}
