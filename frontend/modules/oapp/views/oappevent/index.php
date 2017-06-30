<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\oapp\models\OappEventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Oapp Events';
$this->params['breadcrumbs'][] = $this->title;
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
<div class="bg-teal disabled color-palette">
    
</div>

<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><p align="center">* กรุณานัดล่วงหน้าก่อน 2 วัน</p></h4>
    <h5><p align="center">* วันอังคาร,วันพฤหัสบดี --> หมอณัฐพล เวลา 9.00-12.00 น.</p></h5>
    <h5><p align="center">* วันพุธ,วันศุกร์ --> หมอหทัยรัตน์ เวลา 9.00-12.00 น.</p></h5>
    
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <div class="pull-left"><span style="font-weight: bold;" class="btn btn-github btn-flat"><h5><i class="fa fa-bookmark-o"></i>&nbsp;&nbsp;ระบบนัดการตรวจ หูคอจมูก ออนไลน์</h5></span></div>
                <div class="box-tools pull-right">
                    <button type="button" class="btn bg-purple margin" id="btnedit"><i class="fa fa-plus-square">&nbsp;&nbsp;แก้ไขนัด</i></button>
                    <button type="button" class="btn bg-olive margin" id="btnadd"><i class="fa fa-plus-square">&nbsp;&nbsp;ลงนัด</i></button>
                </div>

            </div>
            <div class="box-body">
                <!--<div class="col-md-1"></div> -->
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
        </div>
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
        
   $('#btnedit').click(function() {
       window.location='./index.php?r=oapp/oappevent/oedit';
   });
        

   
JS;
$this->registerJs($script);
?>