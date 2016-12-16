<?php

namespace frontend\modules\emr\controllers;

use yii\web\Controller;
use Yii;

/**
 * Default controller for the `emr` module
 */
class DefaultController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {

        $cid = Yii::$app->request->post('cid');
        $tname ='';
        $taddr = '';
        $sex = '1';
        $chronic = '';
        $sql = "SELECT p.cid,CONCAT(n.prename,p.name,' ',p.lname) AS tname,sex,
                CONCAT('เลขที่ ',h.HOUSE,' ต.',t.tambonname,' อ.',a.ampurname,' จ.',c.changwatname) AS taddr,
                tc.chronic
                FROM person p
                LEFT JOIN cprename n ON n.id_prename = p.prename
                LEFT JOIN home h ON h.HOSPCODE = p.HOSPCODE AND h.HID = p.HID
                LEFT JOIN tmp_chronic tc on tc.cid = p.cid
                LEFT JOIN campur a ON a.ampurcode = h.AMPUR AND a.changwatcode =  h.CHANGWAT
                LEFT JOIN cchangwat c  ON c.changwatcode = h.CHANGWAT
                LEFT JOIN ctambon t ON t.tamboncode = h.TAMBON AND t.ampurcode = CONCAT(c.changwatcode,a.ampurcode)
                WHERE  p.cid = '$cid' 
                LIMIT 1";
        $connection = Yii::$app->db3;
        $data = $connection->createCommand($sql)
                ->queryAll();

        for ($i = 0; $i < sizeof($data); $i++) {
            $tname = $data[$i]['tname'];
            $taddr = $data[$i]['taddr'];
            $sex = $data[$i]['sex'];
            $chronic = $data[$i]['chronic'];
            
            
        }
        
        
        // ข้อมูลวันที่มารักษา
        $sqld = "SELECT s.date_serv,time_serv,s.hospcode,seq,h.hospname,p.pid
                FROM service s
                LEFT JOIN person p ON p.hospcode = s.hospcode AND p.pid =s.pid
                LEFT JOIN chospcode h ON h.hospcode = s.hospcode
                WHERE  cid = '$cid'
                ORDER BY date_serv DESC";
         try {
                $rawData = \Yii::$app->db3->createCommand($sqld)->queryAll();
            } catch (\yii\db\Exception $e) {
                throw new \yii\web\ConflictHttpException('sql error');
            }
            $dataProvider = new \yii\data\ArrayDataProvider([
                //'key' => 'hoscode',
                'allModels' => $rawData,
                'pagination' => [
                    'pageSize' => 50
                ],
            ]);

        return $this->render('index', ['cid' => $cid,'tname'=>$tname,'taddr'=>$taddr,'sex'=>$sex,'chronic'=>$chronic,
                                       'dataProvider' => $dataProvider 
                                        ]);
    }

}
