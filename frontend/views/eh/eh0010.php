<?php

use kartik\grid\GridView;
use kartik\export\ExportMenu;
use yii\widgets\Breadcrumbs;



echo Breadcrumbs::widget([
    'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
    'links' => [
            [
            'label' => 'ข้อมูล 43 แฟ้ม',
            //'url' => ['post-category/view'],
            //'template' => "<li><b>{link}</b></li>\n", // template for this link only
        ],
            
        [
            'label' => 'เอ๊ะ!!',
            'url' => ['eh/'],
            //'template' => "<li><b>{link}</b></li>\n", // template for this link only
        ],
        'Eh001-->ผู้ป่วย Type 1 กับ 3 ที่อยู่ใน Patient แต่ไม่อยู่ในบัญชี 1'
    ],
]);

?>


 <div class="col-md-12">
    <h3 class="box-title">ตรวจสอบข้อมูล 43 แฟ้ม</h3>
    <div class="box box-info box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Eh001-->ผู้ป่วย Type 1 กับ 3 ที่อยู่ใน Patient แต่ไม่อยู่ในบัญชี 1</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <?php
                    $gridColumns = [
                            [
                            'attribute' => 'hn',
                            'label' => 'hn'
                        ],
                            [
                            'attribute' => 'cid',
                            'label' => 'cid'
                        ],
                            [
                            'attribute' => 'tname',
                            'header' => 'ชื่อ-สกุล'
                        ],
                            [
                            'attribute' => 'taddr',
                            'header' => 'ที่อยู่'
                        ],
                           
                            [
                            'attribute' => 'moopart',
                            'header' => 'หมู่'
                        ],
                            [
                            'attribute' => 'tmbpart',
                            'header' => 'ตำบล'
                        ],
                            [
                            'attribute' => 'amppart',
                            'header' => 'อำเภอ'
                        ],
                            [
                            'attribute' => 'chwpart',
                            'header' => 'จังหวัด'
                        ]
                    ];

                    echo '<div class="col-md-12" align="right" >';
                    echo ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => $gridColumns
                    ]);
                    echo '</div>';
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'autoXlFormat' => true,
                        'export' => [
                            'fontAwesome' => true,
                            'showConfirmAlert' => false,
                            'target' => GridView::TARGET_BLANK
                        ],
                        'columns' => $gridColumns,
                        'resizableColumns' => true,
                        'resizeStorageKey' => Yii::$app->user->id . '-' . date("m"),
                        //'floatHeader' => true,
                        //'floatHeaderOptions' => ['scrollingTop' => '100'],
                        'pjax' => true,
                        'pjaxSettings' => [
                            'neverTimeout' => true,
                        //'beforeGrid' => 'My fancy content before.',
                        //'afterGrid' => 'My fancy content after.',
                        ],
                    ]);
                    ?>
            
        </div>
    </div>
 </div>
                    
  
            
            
  
