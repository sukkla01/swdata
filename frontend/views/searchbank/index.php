
<?php

use yii\bootstrap\Html;

$this->title = 'dashboard';
?>
<?php
if (Yii::$app->request->isPost) {

    if ($_POST['cid'] <> '') {
        $cid = $_POST['cid'];
        $sql = "SELECT b.cid,CONCAT(b.prename,b.fname,'  ',b.lname) AS tname,
        IF(p.pttype='29','Y','N') AS tcheck,pt.name AS ptname
        FROM ict001_bank_gsb  b
        LEFT JOIN patient p ON p.cid=b.cid
        LEFT JOIN pttype pt ON pt.pttype=p.pttype
        WHERE b.cid LIKE '%$cid%'";
    } else if ($_POST['tname'] <> '') {
        $name = $_POST['tname'];
        $sql = "SELECT b.cid,CONCAT(b.prename,b.fname,'  ',b.lname) AS tname,
        IF(p.pttype='29','Y','N') AS tcheck,pt.name AS ptname
        FROM ict001_bank_gsb  b
        LEFT JOIN patient p ON p.cid=b.cid
        LEFT JOIN pttype pt ON pt.pttype=p.pttype
        WHERE CONCAT(b.prename,b.fname,'  ',b.lname) LIKE '%$name%'";
    }
    $connection = Yii::$app->db2;
    $data = $connection->createCommand($sql)
            ->queryAll();
}
?>
<div class="site-index">
    <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                       ค้นหาผู้ป่วยพนักงานธนาคาร

                       
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    
                </div>
            </div>
    </div>


    <div class="body-content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"> <i class='glyphicon glyphicon-search'></i> ค้นหาผู้ป่วยพนักงานธนาคาร</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?= Html::beginForm(); ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>เลขบัตรประชาชน 13 หลัก</label>
                                <input type="text" name="cid" class="form-control" placeholder="XXXXXXXXXXXXX">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ชื่อ-สกุล</label>
                                <input type="text"  name="tname" class="form-control" placeholder="ตัวอย่าง">
                            </div>
                        </div>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-success']); ?>


                        <?= Html::endForm(); ?>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<?php if (Yii::$app->request->isPost) { ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title"><i class='fa  fa-desktop'></i> แสดงรายชื่อที่ค้นหา</h3>

                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr bgcolor="ccccb3">
                        <th>#</th>
                        <th>บัตร ปปช. 13 หลัก</th>
                        <th>ชื่อ-สกุล</th>
                        <th>สิทธิ์ปัจจุบัน(hos)</th>
                        <th>สถานะ</th>
                        <th>เปลี่ยนสิทธิ์</th>
                    </tr>
                    <?php for ($i = 0; $i < sizeof($data); $i++) { ?>
                        <?php $cid = $data[$i]['cid']; ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $data[$i]['cid'] ?></td>
                            <td><?= $data[$i]['tname'] ?></td>
                            <td><?= $data[$i]['ptname'] ?></td>
                            <td>
                                <?php if ($data[$i]['tcheck'] == "Y") { ?>
                                    <button type="button" class="btn btn-block btn-success">success</button>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-block btn-danger">success</button>
                                <?php } ?>
                            </td>
                            <td> <?= Html::a('ตกลง', ['', 'cid' => $cid], ['class' => 'btn btn-success']) ?></td>
                        </tr>
                    <?php } ?>

                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
<?php } ?>






