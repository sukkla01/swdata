<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>




<div class="panel panel-danger">
    <div class="panel-heading">
        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool"  id="taf" data-dismiss="modal"><i class="fa fa-times"></i></button>
    </div>
        <h3 class="panel-title"><i class="fa fa-ban" ></i>&nbsp;&nbsp;การวินิจฉัยโรคทั้งหมดของ AN : <?= $an ?></h3>
        
    </div>
    
    <div class="panel-body">
        <div class="modal-body">
            <?php
            $sql = "SELECT i.diagtype,i.icd10,d.name,CONCAT(p.pname,p.fname,' ',p.lname) AS tname
                    FROM iptdiag i
                    LEFT JOIN ipt t ON t.an = i.an
                    LEFT JOIN icd101 d ON d.code = i.icd10
                    LEFT JOIN patient p ON p.hn =t.hn
                    WHERE i.an='$an'
                    ORDER BY  diagtype";
            $connection = Yii::$app->db2;
            $data = $connection->createCommand($sql)
                    ->queryAll();
            ?>

            <table class="table">
                <thead class="thead-inverse">
                    <tr>
                        <th>#</th>
                        <th>รหัส</th>
                        <th>วินิจฉัย</th>
                        <th>Diagtype</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < sizeof($data); $i++) { ?>
                        <tr>
                            <th scope="row"><?= $i + 1 ?></th>
                            <td><?= $data[$i]['icd10']; ?></td>
                            <td><?= $data[$i]['name']; ?></td>
                            <td><?= $data[$i]['diagtype']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<div class="modal-footer">

    <button type="button" class="btn btn-danger" id="clan" data-dismiss="modal">ปิด</button>
</div>


<?php
$script = <<< JS
        
 //----------- ปุ่มปิด -------------------------       
$('#taf').click(function() {
                    
                           window.location='./index.php?r=report/mrs001&date1=' + $date1 +'date2='+$date2;
  });
        
  $('#clan').click(function() {
                    
                           window.location='./index.php?r=report/mrs001&date1=' + $date1 +'date2='+$date2;
  });
        

    
        

   
JS;
$this->registerJs($script);
?>
