<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\bmd\models\Bonemass */

$this->title = 'Create Bonemass';
$this->params['breadcrumbs'][] = ['label' => 'Bonemasses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bonemass-create">



    <?= $this->render('_form', [
        'model' => $model,
        'vn' => $vn, 'hn' => $hn, 'vstdate' => $vstdate,'date1'=>$date1,
                'date2'=>$date2,'id'=>$id,
    ]) ?>

</div>
