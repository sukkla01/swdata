
<?php

use kartik\grid\GridView;
?>

<?php

$gridColumns = [
        [
        'attribute' => 'vstdate',
        'label' => 'วันที่ Refer'
    ],
        [
        'attribute' => 'hmain',
        'label' => 'โรงพยาบาลหลัก'
    ],
        [
        'attribute' => 'hreferout',
        'label' => 'refer ไป'
    ],
        [
        'attribute' => 'hreferin',
        'label' => 'รับ refer'
    ],
];

echo GridView::widget([
    'dataProvider' => $dataProviderRefer,
    //'filterModel' => $searchModel,
    'autoXlFormat' => true,
    'export' => [
        'fontAwesome' => true,
        'showConfirmAlert' => false,
        'target' => GridView::TARGET_BLANK
    ],
    'columns' => $gridColumns,
    'resizableColumns' => true,
        //'resizeStorageKey' => Yii::$app->user->id . '-' . date("m"),
]);
?>