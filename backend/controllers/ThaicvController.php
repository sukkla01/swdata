<?php

namespace backend\controllers;
use Yii;

class ThaicvController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionProcess()
    {
        $sql="INSERT IGNORE INTO swdata.tmb_thaicvrisk_ngob

                SELECT c.hn,o.vn,o2.vstdate,bps,tc,waist,height,smoking_type_id,NULL,NULL,'2559'
                FROM clinicmember  c
                LEFT JOIN (SELECT MAX(vn) AS vn,hn FROM opdscreen WHERE vstdate BETWEEN '2015-10-01' AND '2016-09-30' AND bps>0 AND (waist >0 or tc >0) GROUP BY hn ) o ON o.hn=c.hn
                LEFT JOIN (SELECT vstdate,vn,bps,tc,waist,height,smoking_type_id FROM opdscreen WHERE vstdate BETWEEN  '2015-10-01' AND '2016-09-30' ) o2 ON o2.vn=o.vn
                WHERE clinic IN('013','029')
                GROUP BY c.hn";
        
            $connection = Yii::$app->db2;
            $data = $connection->createCommand($sql)->execute();
        
         $sql_dm = "UPDATE swdata.tmb_thaicvrisk_ngob t
                    LEFT JOIN (SELECT hn FROM ovstdiag WHERE icd10 BETWEEN 'e10' AND 'e14' GROUP BY hn) o1 ON o1.hn=t.hn
                    SET t.is_dm=if(o1.hn IS NULL,'N','Y')";
          $data = $connection->createCommand($sql_dm)->execute();
          
          $sql_ht = "UPDATE swdata.tmb_thaicvrisk_ngob t
                    LEFT JOIN (SELECT hn FROM ovstdiag WHERE icd10 BETWEEN 'i10' AND 'i15' GROUP BY hn) o1 ON o1.hn=t.hn
                    SET t.is_ht=if(o1.hn IS NULL,'N','Y')";
          $data = $connection->createCommand($sql_ht)->execute();
          
          $sql_age = "UPDATE swdata.tmb_thaicvrisk_ngob t
                INNER JOIN hos.patient p ON p.hn = t.hn
                SET t.age=YEAR(CURDATE())-YEAR(p.birthday)";
          $data = $connection->createCommand($sql_age)->execute();
        
          
          $sql_web = "INSERT INTO tmb_thaicvrisk_ngob_web 

                        SELECT tt.*,
                        IF(tc1>0,c2.color,c1.color) AS tcolor
                        FROM(
                        SELECT n.*,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,
                        if(age<50,40,if(age<55,50,if(age<60,55,if(age<65,60,65)))) as tage,
                        if(bps>0,if(bps<140,120,if(bps<160,140,if(bps<180,160,180))),0) as tsbp,
                        if(waist>0,if(n.height>0,if(waist>(n.height/2),2,1),0),0) as twaist,
                        if(tc>0,if(tc<200,160,if(tc<240,200,if(tc<280,240,if(tc<320,280,320)))),0) as tc1,
                        p.sex
                        FROM swdata.tmb_thaicvrisk_ngob n
                        INNER JOIN hos.patient p ON p.hn=n.hn ) AS tt
                        LEFT JOIN hos.colorchart59 c1 ON c1.is_dm=tt.is_dm AND c1.sex=tt.sex  AND  c1.is_smoker=IF(smoker =2 ,'Y','N')   AND  c1.age=tt.tage and c1.sbp=tt.tsbp and c1.waist=tt.twaist
                        LEFT JOIN hos.colorchart59 c2 ON c2.is_dm=tt.is_dm AND c2.sex=tt.sex  AND  c2.is_smoker=IF(smoker =2 ,'Y','N')   AND  c2.age=tt.tage and c2.sbp=tt.tsbp and c2.tc=tt.tc1
                        GROUP BY tt.hn
                        ORDER BY tcolor";
          $data = $connection->createCommand($sql_web)->execute();
        
        return $this->render('index');
    }

}
