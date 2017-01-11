<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FoodDetail01 */

$this->title = 'Create Food Detail01';
$this->params['breadcrumbs'][] = ['label' => 'Food Detail01s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-detail01-create">

   

    <?= $this->render('_form', [
        'model' => $model,
        'an' => $an, 'bed' => $bed, 'tname' => $tname,
        'hn' => $hn, 'ptname' => $ptname, 'ward' => $ward
    ]) ?>

</div>
