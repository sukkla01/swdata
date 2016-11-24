<?php

namespace  frontend\controllers;

class SearchbankController extends \common\components\AppController
{
    public function actionIndex()
    {
        $this->permitRole([1,2,3]);
        return $this->render('index');
    }

}
