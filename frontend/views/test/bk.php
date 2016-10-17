<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use linchpinstudios\backstretch;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UsertypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usertypes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usertype-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Usertype', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    echo Backstrech::widget([
    'duration' => 3000,
    'fade' => 750,
    'clickEvent' => false,
    'images' => [
      ['image' => 'http://dl.dropbox.com/u/515046/www/outside.jpg'],
      ['image' => 'http://dl.dropbox.com/u/515046/www/garfield-interior.jpg'],
      ['image' => 'http://dl.dropbox.com/u/515046/www/cheers.jpg'],
    ],
  ]);
    ?>

</div>