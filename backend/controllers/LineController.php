<?php

namespace backend\controllers;

class LineController extends \common\components\AppController
{
    public function actionIndex()
    {
       
        return $this->render('index');
    }
     public function actionLine()
    {
         $this->permitRole([1]);
        return $this->render('line');
    }


}
