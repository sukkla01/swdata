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
        'Eh009--> ไม่ใช่คนไทย แต่สถานะบุคคล เป็น Type 1,3'
    ],
]);
?>

<div class="row">
    <div class="col-md-12">
        <h3 class="box-title">ตรวจสอบข้อมูล 43 แฟ้ม</h3>
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Eh009--> ไม่ใช่คนไทย แต่สถานะบุคคล เป็น Type 1,3</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
<?php
$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
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
</div>





