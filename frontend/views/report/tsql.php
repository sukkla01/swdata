

<?php 

    $tsql = $_GET['tsql'];
    $reportname = $_GET['reportname'];
 echo '<h1>SQL-->'.$reportname.'</h1>';
 ?>
<div class="col-md-8">
<?php
 echo $tsql;
 ?>
</div>