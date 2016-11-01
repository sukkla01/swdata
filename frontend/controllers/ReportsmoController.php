<?php
namespace frontend\controllers;
use yii\web\Session;
$session = new Session;
$session->open();

use Yii;

class ReportsmoController extends  \common\components\AppController  {

    public function actionHdugfr() {

        $this->permitRole([1, 3]);
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        if (Yii::$app->request->isPost) {
           
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
            $date1 =$session['fff'];
            $date2 =$session['jjj']; 
            
            
        }
        
        $sql = "select p.hn,concat(pname,fname,' ',lname) as tname,lo.lab_order_result,p.sex,IF(vs.age_y IS NULL,a.age_y,vs.age_y) as age,a.an,a.age_y,
                                     if(department='OPD',s.name,w.name) as tspclty,l.vn,albu.lab_order_result AS albu_result,micro.lab_order_result AS micro_result,TEST.lab_order_result AS test_result,
                                     concat(p.addrpart,'  ',p.moopart,' ' ,t.full_name) as addrfull,pt.name as ptname,department,
								 p.addressid,p.moopart,p.tmbpart,p.amppart,p.chwpart,											
                                     if(department='OPD',concat(vs.dx0,' ',vs.dx1,' ',vs.dx2,' ',vs.dx3,' ',vs.dx4),concat(a.dx0,a.dx1,a.dx2,a.dx3,a.dx4)) as icd10dx,
                                     if(p.sex=1,if(lo.lab_order_result<=0.9,141 * exp(-0.411 * log(lo.lab_order_result / 0.9)) * exp((IF(vs.age_y IS NULL,a.age_y,vs.age_y))* log(0.993)),141 * exp(-1.209 * log(lo.lab_order_result/ 0.9)) * exp((IF(vs.age_y IS NULL,a.age_y,vs.age_y)) * log(0.993))),
                                     if(lo.lab_order_result<= 0.7,144 * exp(-0.329 * log(lo.lab_order_result / 0.7)) * exp((IF(vs.age_y IS NULL,a.age_y,vs.age_y)) * log(0.993)),144 * exp(-1.209 * log(lo.lab_order_result/ 0.7)) * exp((IF(vs.age_y IS NULL,a.age_y,vs.age_y))  * log(0.993)))) as gfr
														
                                     from lab_head l
                                     left join lab_order lo on lo.lab_order_number=l.lab_order_number
                                     left join patient p on p.hn=l.hn
                                     left join thaiaddress t on t.chwpart=p.chwpart and t.amppart=p.amppart and t.tmbpart=p.tmbpart
                                     left join ovst o on o.vn=l.vn
                                     left join pttype pt on pt.pttype=o.pttype
                                     left join ipt i on i.an=l.vn
                                     left join spclty s on s.spclty=o.spclty
                                     left join ward w on w.ward=i.ward
                                     left join vn_stat vs on vs.vn=o.vn
                                     left join an_stat a on a.an=i.an
					LEFT JOIN (SELECT lab_items_code,lab_order_result,vn
																								FROM  lab_head l
																								LEFT JOIN lab_order lo ON lo.lab_order_number =l.lab_order_number
																								WHERE  lo.lab_items_code IN('364','524')) AS albu ON albu.vn=l.vn
				    LEFT JOIN (SELECT lab_items_code,lab_order_result,vn
																								FROM  lab_head l
																								LEFT JOIN lab_order lo ON lo.lab_order_number =l.lab_order_number
																								WHERE  lo.lab_items_code ='588' group by vn ) AS micro ON micro.vn=l.vn
                                     LEFT JOIN (SELECT lab_items_code,lab_order_result,vn
																								FROM  lab_head l
																								LEFT JOIN lab_order lo ON lo.lab_order_number =l.lab_order_number
																								WHERE  lo.lab_items_code ='618' group by vn ) AS TEST ON TEST.vn=l.vn
                                     where l.order_date between  '$date1' and '$date2'   and lo.lab_items_code='78' and  o.spclty IN('13','47')";
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 20
            ],
        ]);
        return $this->render('hdugfr',['dataProvider' => $dataProvider,'date1'=>$date1,'date2'=>$date2]);
    }
     public function actionIndex() {
         return $this->render('index'); 
     }

}
