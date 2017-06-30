<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\oapp\models\OappEvent */

$this->title = 'Create Oapp Event';
$this->params['breadcrumbs'][] = ['label' => 'Oapp Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oapp-event-create">

    <?= $this->render('_form', [
        'model' => $model,'tlimit'=>$tlimit,'type'=>$type,'holiday'=>$holiday,'date'=>$date,'hol'=>$hol,'update1'=>$update1,'id'=>$id,
        'hn'=>$hn,'tname'=>$tname,'cid'=>$cid,'tel'=>$tel,'pttype'=>$pttype,'create_date'=>$create_date
    ]) ?>

</div>
