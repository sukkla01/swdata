<?php

namespace frontend\controllers;

use Yii;
use app\models\TmpThaicvriskSearch;

class ThaicvriskController extends \common\components\AppController {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionThaidetail() {
        $this->permitRole([1, 3]);
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        if (isset($_GET['page'])) {
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];
        }
        if (Yii::$app->request->isPost) {
            if (isset($_POST['date1']) == '') {
                $date1 = Yii::$app->session['date1'];
                $date2 = Yii::$app->session['date2'];
            } else {

                $date1 = $_POST['date1'];
                $date2 = $_POST['date2'];
                Yii::$app->session['date1'] = $date1;
                Yii::$app->session['date2'] = $date2;
            }
        }
        $connection = Yii::$app->db2;

        if (!isset($_GET['page'])) {
            $connection->createCommand("DELETE FROM swdata.tmp_thaicvrisk ")->execute();
        }


        $sql = "INSERT IGNORE INTO swdata.tmp_thaicvrisk

                SELECT NULL,vstdate,hn,vn,tname,age_y,bps,tc1,sex,is_dm,smoker,waist,height,tcolor
                FROM (           
                SELECT v.vstdate,v.hn,v.vn,ta.age,tbp.sbp,tbp.waist1,tc1,p.sex,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,
                IF(tdm.vn IS NULL,'N','Y') AS is_dm,IF(tbp.smoker =2 ,'Y','N') AS smoker,vd.icd10,c1.color,o.waist,o.height,
                v.age_y,o.bps,
                IF(tc1>0,c2.color,c1.color) AS tcolor
                FROM vn_stat v
                LEFT JOIN (SELECT vn,if(age_y<50,40,if(age_y<55,50,if(age_y<60,55,if(age_y<65,60,65)))) as age FROM vn_stat WHERE vstdate BETWEEN '$date1' AND '$date2' ) as ta ON ta.vn=v.vn 
                LEFT JOIN (SELECT vn,if(os.bps>0,if(os.bps<140,120,if(os.bps<160,140,if(os.bps<180,160,180))),0) as sbp,
                                                                   if(os.waist>0,if(os.height>0,if(os.waist>(os.height/2),2,1),0),0) as waist1,
                                                                   if(os.tc>0,if(os.tc<200,160,if(os.tc<240,200,if(os.tc<280,240,if(os.tc<320,280,320)))),0) as tc1,
                                                                   smoking_type_id AS smoker
                           FROM opdscreen os WHERE vstdate BETWEEN '$date1' AND '$date2'  ) AS tbp ON tbp.vn=v.vn
                LEFT JOIN ovstdiag vd ON vd.vn=v.vn
                LEFT JOIN (SELECT vn FROM ovstdiag where vstdate BETWEEN '$date1' AND '$date2' AND icd10 between 'E10' and 'E14'  ) as tdm ON tdm.vn=v.vn
                LEFT JOIN opdscreen o ON o.vn = v.vn
                LEFT JOIN patient p ON p.hn=v.hn
                LEFT JOIN colorchart59 c1 ON c1.is_dm=IF(tdm.vn IS NULL,'N','Y') AND c1.sex=p.sex  AND  c1.is_smoker=IF(tbp.smoker =2 ,'Y','N')  AND  c1.age=ta.age and c1.sbp=tbp.sbp and c1.waist=tbp.waist1
                LEFT JOIN colorchart59 c2 ON c2.is_dm=IF(tdm.vn IS NULL,'N','Y') AND c2.sex=p.sex  AND  c2.is_smoker=IF(tbp.smoker =2 ,'Y','N')  AND  c2.age=ta.age and c2.sbp=tbp.sbp and c2.tc=tbp.tc1
                WHERE v.vstdate BETWEEN '$date1' AND '$date2' 
                                                AND (icd10 between 'E10' and 'E14' OR icd10 BETWEEN 'i10' AND 'i15' )
                GROUP BY v.vn
                HAVING tc1>0 OR waist >0 ) AS tt ";


        $connection->createCommand($sql)->execute();

        //-----------  grid view ---------------------------------------
        $searchModel = new TmpThaicvriskSearch();
        $tsql = "select * from swdata.tmp_thaicvrisk ";

        try {
            $rawData = \Yii::$app->db2->createCommand($tsql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 10
            ],
        ]);

        // -------------------- chart -------------------------------
        $gsql = "SELECT '1' AS tcolor,COUNT(DISTINCT vn)  AS tcount FROM swdata.tmp_thaicvrisk t WHERE tcolor='1' 
                UNION
                SELECT '2' AS tcolor,COUNT(DISTINCT vn)  AS tcount FROM swdata.tmp_thaicvrisk t WHERE tcolor='2'
                UNION
                SELECT '3' AS tcolor,COUNT(DISTINCT vn)  AS tcount FROM swdata.tmp_thaicvrisk t WHERE tcolor='3'
                UNION
                SELECT '4' AS tcolor,COUNT(DISTINCT vn)  AS tcount FROM swdata.tmp_thaicvrisk t WHERE tcolor='4'
                UNION
                SELECT '5' AS tcolor,COUNT(DISTINCT vn)  AS tcount FROM swdata.tmp_thaicvrisk t WHERE tcolor='5'";
        $gdata = $connection->createCommand($gsql)
                ->queryAll();

        for ($i = 0; $i < sizeof($gdata); $i++) {
            $tcolor[] = $gdata[$i]['tcolor'] * 1;
            $tcount[] = $gdata[$i]['tcount'] * 1;

            //$m2[] = $data[$i]['m2'] * 1;
        }
        return $this->render('thaidetail', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel, 'date1' => $date1, 'date2' => $date2, 'sql', $sql, 'tcolor' => $tcolor, 'tcount' => $tcount]);
    }

    public
            function actionClinic() {
        $this->permitRole([1, 2, 3]);
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        $color = '';
        $type1 = '';
        if (isset($_GET['page'])) {
            $color = Yii::$app->session['color'];
            $type = Yii::$app->session['type'];
        }
        if (Yii::$app->request->isPost) {

            if (!isset($_POST['type']) or ! isset($_POST['color'])) {
                $color = Yii::$app->session['color'];
                $type = Yii::$app->session['type'];
            } else {
                $type = $_POST['type'] * 1;
            }

            if (isset($_POST['color']) <> '0') {
                $color = $_POST['color'];
                $color = 'where tcolor=' . $color;
                Yii::$app->session['color'] = $color;
                if ($_POST['color'] == 'null') {
                    $color = 'where tcolor IS NULL';
                    Yii::$app->session['color'] = $color;
                }
            }
            if ($type <> 0) {
                if ($type == 1) {
                    $type = 'dm';
                } else if ($type == 2) {
                    $type = 'ht';
                } else if ($type == 3) {
                    $type = 'dmht';
                }
                $type1 = "HAVING type =" . "'" . $type . "'";
                Yii::$app->session['type'] = $type1;
            } else {
                $type = '';
            }
        }

        if ($color == 'where tcolor=0') {
            $color = '';
        }



        $sql = "SELECT hn,vn,vstdate,bps,tc,waist,height,IF(smoker =2 ,'Y','N') AS smoker,is_dm,is_ht,age,tname,tcolor,
              IF(sex=1,'ชาย',IF(sex=2,'หญิง','ไม่ทราบ')) as sex1,sex,
                IF(is_dm='Y' AND is_ht='N','DM',IF(is_dm='N' AND is_ht='Y','HT',IF(is_dm='Y' AND is_ht='Y','DMHT','ไม่หราบ')))  AS type
                FROM swdata.tmb_thaicvrisk_ngob_web 
                $color
                $type1
                Order BY hn";

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


        return $this->render('clinic', ['dataProvider' => $dataProvider, 'color' => $color, 'type' => $type1]);
    }

}
