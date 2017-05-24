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
        'model' => $model,
    ]) ?>

</div>
