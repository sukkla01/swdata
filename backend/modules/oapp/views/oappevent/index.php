<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\oapp\models\OappEventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>


<?php
        Modal::begin([
            'header' => '<h4>บันทึกข้อมูลการนัด</h4>',
            'id' => 'modal',
            'size' => 'modal-lg'
        ]);
        echo "<div id='modalContent'></div>";
        Modal::end();
?>

<div class="row">
    <div class="col-md-12">
        
                    <?php
                    echo \yii2fullcalendar\yii2fullcalendar::widget(array(
                        'events' => $events,
                        'options' => [
                            'lang' => 'th',
                        //... more options to be defined here!
                        ],
                    ));
                    ?> 
    </div>
</div>




<?php
$script = <<< JS
   var holiday; 
   
   $(document).on('click','.fc-sat',function(){
        holiday = 'sat';
   });
   $(document).on('click','.fc-sun',function(){
        holiday = 'sun';
   });
   $(document).on('click','.fc-mon',function(){
        holiday = 'mon';
   });
   $(document).on('click','.fc-tue',function(){
        holiday = 'tue';
   });
   $(document).on('click','.fc-wed',function(){
        holiday = 'wed';
   });
   $(document).on('click','.fc-thu',function(){
        holiday = 'thu';
   });
   $(document).on('click','.fc-fri',function(){
        holiday = 'fri';
   });
      
        
        
        
$(document).on('click','.fc-day',function(){
        var date = $(this).attr('data-date');
         //console.log(holiday);
        $.get('index.php?r=oapp/oappevent/create',{'date':date,'type':0,'holiday':holiday},function(data){
            $('#modal').modal('show')
            .find('#modalContent')
            .html(data);
        
         });
        
   });
        
  
        
$(document).on('click','.fc-day-top',function(){
        var date = $(this).attr('data-date');
        $.get('index.php?r=oapp/oappevent/create',{'date':date,'type':0,'holiday':holiday},function(data){
            $('#modal').modal('show')
            .find('#modalContent')
            .html(data);
        
         });
        
   });        
        
 $('#btnadd').click(function() {
        var date = '';
        $.get('index.php?r=oapp/oappevent/create',{'date':date,'type':1},function(data){
            $('#modal').modal('show')
            .find('#modalContent')
            .html(data);
        
         });
        
   });
        

   
JS;
$this->registerJs($script);
?>