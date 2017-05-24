<?php

use yii\helpers\Url;
?>

<div class="row">
    <div class="col-sm-1">

    </div>
    <div class="col-sm-10">

        <?php
        /* echo yii2fullcalendar\yii2fullcalendar::widget([
          'options' => [
          'lang' => 'th',
          //... more options to be defined here!
          ],
          'ajaxEvents' => Url::to(['/timetrack/default/jsoncalendar'])
          ]); */

        echo \yii2fullcalendar\yii2fullcalendar::widget(array(
            'events' => $events,
        ));
        ?>
    </div>

</div>