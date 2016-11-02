<?php

use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

echo Breadcrumbs::widget([
    'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
    'links' => [
            [
            'label' => 'ระบบรายงาน',
        //'url' => ['post-category/view'],
        //'template' => "<li><b>{link}</b></li>\n", // template for this link only
        ],
        'ระบบรายงานใหม่'
    ],
]);

//------------------- module --------------

$sql = "SELECT url,module,modulename,COUNT(id) as tcount FROM reporttemplate GROUP BY module";
$connection = Yii::$app->db;
$data = $connection->createCommand($sql)
        ->queryAll();

//------------------- module detail --------------
if (isset($_GET['module']) <> '') {
    $module = $_GET['module'];
    $sqld = "SELECT * FROM reporttemplate WHERE module ='$module'";
    $connection = Yii::$app->db;
    $datad = $connection->createCommand($sqld)
            ->queryAll();
}
?>
<div class="row">
    <div class="col-md-3">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">ระบบรายงาน</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?php $color = "bgcolor='e6f5ff'"; ?>
                <table class="table table-hover">

                    <tr bgcolor="ccccb3">
                        <th>#</th>
                        <th>Module</th>
                        <th>จำนวน</th>

                    </tr>
                    <?php for ($i = 0; $i < sizeof($data); $i++) { ?>
                        <tr <?= $color ?> >
                            <td><?= $i + 1 ?></td>
                            <?php
                            $module = $data[$i]['module'];
                            ?>
                            <td><a href="<?= Url::to(['report/', 'module' => $module]) ?>"><?= $data[$i]['modulename'] ?></a></td>
                            <td> <?= $data[$i]['tcount'] ?></td>

                        </tr>   
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">ระบบรายงาน</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?php $color = "bgcolor='e6f5ff'"; ?>
                <table class="table table-hover">

                    <tr bgcolor="ccccb3">
                        <th>#</th>
                        <th>Module</th>
                        <th>ชื่อรายงาน</th>
                        <th align="center">Preview</th>
                    </tr>
                    <?php if (isset($_GET['module']) <> '') { ?>
                        <?php for ($i = 0; $i < sizeof($datad); $i++) { ?>
                            <tr <?= $color ?> >
                                <td><?= $i + 1 ?></td>

                                <?php
                                $module = $datad[$i]['module'];
                                $url ='index.php?r='.$datad[$i]['url'];
                                ?>
                                <td><?= $module ?></td>
                                <td><?= $datad[$i]['reportname'] ?></td>
                                <td><a href="<?= Url::to($url) ?>" target="_blank"><i class='fa fa-tv'></i></a></td>


                            </tr>   
                        <?php } ?>
                    <?php } ?>

                </table>
            </div>
        </div>
    </div>
</div>

