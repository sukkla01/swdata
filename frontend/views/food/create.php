<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use prawee\widgets\ButtonAjax;
use yii\bootstrap\Modal;
?>


<?php
    echo ButtonAjax::widget([
        'name'=>'Create',
        'route'=>['create'],
        'modalId'=>'#main-modal',
        'modalContent'=>'#main-content-modal',
        'options'=>[
            'class'=>'btn btn-success',
            'title'=>'Button for create application',
        ]
    ]);
   
    Modal::begin(['id'=>'main-modal']);
    echo '<div id="main-content-modal">ddd</div>';
    Modal::end();
?>
