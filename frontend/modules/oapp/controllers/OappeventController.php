<?php

namespace app\modules\oapp\controllers;

use Yii;
use app\modules\oapp\models\OappEvent;
use app\modules\oapp\models\OappEventSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\oapp\models\OappShow;

Yii::$app->formatter->locale = 'th_TH';

/**
 * OappeventController implements the CRUD actions for OappEvent model.
 */
class OappeventController extends Controller {

    /**
     * @inheritdoc
     *
      public function behaviors() {
      return [
      'verbs' => [
      'class' => VerbFilter::className(),
      'actions' => [
      'delete' => ['POST'],
      ],
      ],
      ];
      }

      /**
     * Lists all OappEvent models.
     * @return mixed
     */
    public function actionIndex() {

        $events = OappShow::find()->all();



        $masker = [];
        foreach ($events as $eve) {
            if ($eve->tcount > 4) {
                $text = "เต็ม";
            } else if ($eve->tcount == 'sat') {
                $text = 'ไม่มีตรวจ';
            } else if ($eve->tcount == 'sun') {
                $text = 'ไม่มีตรวจ';
            } else if ($eve->tcount == 'mon') {
                $text = 'ไม่มีตรวจ';
            } else {
                $text = '';
            }
            $event = new \yii2fullcalendar\models\Event();
            $event->id = $eve->id;
            $event->title = $text;
            $event->start = $eve->vstdate;
            $event->end = $eve->vstdate;
            $event->backgroundColor = $eve->color;
            $masker[] = $event;
        }


        return $this->render('index', [
                    'events' => $masker,
        ]);
    }

    /**
     * Displays a single OappEvent model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionOedit() {
        $dataProvider = '';
        $cid = '';
        $id = '';
        $pg=0;
        if (Yii::$app->request->isPost) {

            $cid = md5($_POST['cid']);
            $id = $_POST['id'];
            $pg=1;
        }
        if (isset($_GET['cid'])) {
            $cid = md5($_GET['cid']);
            $id=$_GET['id'];
            $pg=1;
        }
        

        return $this->render('oedit', ['cid' => $cid, 'id' => $id,'pg'=>$pg]);
    }

    /**
     * Creates a new OappEvent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($date) {
        $model = new OappEvent();
        $model->created_date = $date;
        $connection = Yii::$app->db5;
        $holiday = '';
        $hn = '';
        $cid = '';
        $tname = '';
        $tel = '';
        $pttype = '';
         $create_date =$date;

        if (isset($_GET['type'])) {
            $type = $_GET['type'];
        }

        if (isset($_GET['holiday'])) {
            $holiday = $_GET['holiday'];
        }


        if (Yii::$app->request->isPost) {
            $r = $_POST['OappEvent'];
            $date = $r['created_date'];
            $hn = $r['hn'];
            $tname = $r['tname'];
            $tdate = Yii::$app->formatter->asDate($date, 'medium');
        }


        //---------------- update ----------------------
        $update1 = 0;
        $id = 0;
        if (isset($_GET['update'])) {
            $update1 = $_GET['update'];
            $hn = $_GET['hn'];
            $cid = $_GET['cid'];
            $tname = $_GET['tname'];
            $tel = $_GET['tel'];
            $pttype = $_GET['pttype'];
            $create_date = $_GET['create_date'];
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $create_date =$date;
        }





        $sqlalert = "SELECT tcount FROM oapp_show WHERE vstdate='$date'";
        $command = Yii::$app->db5->createCommand($sqlalert);
        $tlimit = $command->queryScalar();

        $sqlhol = "SELECT day_name FROM holiday  WHERE  holiday_date='$date'";
        $command = Yii::$app->db5->createCommand($sqlhol);
        $hol = $command->queryScalar();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $sql = "SELECT COUNT(vstdate) AS tcount FROM oapp_show WHERE vstdate='$date'";
            $command = Yii::$app->db5->createCommand($sql);
            $datecount = $command->queryScalar();

            $sqlt = "SELECT tcount FROM oapp_show WHERE vstdate='$date'";
            $command = Yii::$app->db5->createCommand($sqlt);
            $tcount = $command->queryScalar();

            if ($datecount == 0) {
                $datals = $connection->createCommand("INSERT INTO  oapp_show (vstdate,tcount,color) VALUES ('$date',1,'#00cc99')")->execute();
            } else {
                $datals = $connection->createCommand("UPDATE oapp_show SET tcount =$tcount+1,color=if($tcount<4,'#00cc99','#e60073') WHERE   vstdate='$date'")->execute();
            }

            $datalu = $connection->createCommand("UPDATE oapp_event e
                        LEFT JOIN oapp_pttype p ON p.id = e.pttype
                        SET e.pttype_name = SUBSTR(p.name,3,LENGTH(p.name)-2)
                        WHERE e.id ='$model->id'")->execute();


            //------------- begin notify --------------
            $linetoken = "zCh3BOVSNl1bhzmgaCv2mAHZoNP6D2A3PF2gbrXThAm";
            define('LINE_API', "https://notify-api.line.me/api/notify");
            define('LINE_TOKEN', $linetoken);
            $connection = Yii::$app->db2;
            $getip = Yii::$app->getRequest()->getUserIP();

            function notify_message($message) {

                $queryData = array('message' => $message);
                $queryData = http_build_query($queryData, '', '&');
                $headerOptions = array(
                    'http' => array(
                        'method' => 'POST',
                        'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                        . "Authorization: Bearer " . LINE_TOKEN . "\r\n"
                        . "Content-Length: " . strlen($queryData) . "\r\n",
                        'content' => $queryData
                    )
                );
                $context = stream_context_create($headerOptions);
                $result = file_get_contents(LINE_API, FALSE, $context);
                $res = json_decode($result);
                //return $res;
            }

            $res = notify_message('HN : ' . $hn . ' ชื่อ-สกุล : ' . $tname . ' วันที่นัด : ' . $tdate);
            //var_dump($res);
            //------------- end notify --------------

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->renderAjax('create', [
                        'model' => $model, 'tlimit' => $tlimit, 'type' => $type, 'holiday' => $holiday, 'date' => $date, 'hol' => $hol, 'update1' => $update1, 'id' => $id,
                        'hn' => $hn, 'tname' => $tname, 'cid' => $cid, 'tel' => $tel, 'pttype' => $pttype, 'create_date' => $create_date
            ]);
        }
    }

    public function actionLimit() {
        $tdate = $_GET['tdate'];
        $sql = "SELECT COUNT(hn) tcount FROM oapp_event  WHERE created_date ='$tdate' ";
        $command = Yii::$app->db5->createCommand($sql);
        $btncount = $command->queryScalar();

        return $btncount;
    }

    public function actionHoliday() {
        $tdate = $_GET['tdate'];
        $sql = "SELECT  COUNT(holiday_date) tcount FROM holiday WHERE holiday_date = '$tdate' ";
        $command = Yii::$app->db5->createCommand($sql);
        $holi = $command->queryScalar();

        return $holi;
    }

    public function actionAutohos() {
        $connection = Yii::$app->db2;
        $sql = "SELECT hn,cid,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,pt.name AS pname 
                FROM  patient p 
                LEFT JOIN pttype pt ON pt.pttype = p.pttype
                WHERE cid ='1640700015461' ";
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        return json_encode($rawData);
    }

    /**
     * Updates an existing OappEvent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }
    
     public function actionUpdateoapp() {
         $connection = Yii::$app->db5;
         $id=$_GET['id'];
         $hn=$_GET['hn'];
         $cid=$_GET['cid'];
         $tname=$_GET['tname'];
         $tel=$_GET['tel'];
         $pttype=$_GET['pttype'];
         $cdate=$_GET['cdate'];
         
         
         $datals = $connection->createCommand("UPDATE oapp_event SET hn='$hn',tname='$tname',cid='$cid',pttype='$pttype',tel='$tel',created_date='$cdate'  WHERE id='$id'")->execute();
         
         $datal2 = $connection->createCommand("UPDATE oapp_event o
                                            LEFT JOIN oapp_pttype p ON p.id =o.pttype
                                            SET o.pttype_name=p.name
                                            WHERE o.id='$id' ")->execute();
         
        
         return $datals;
          
     }

    /**
     * Deletes an existing OappEvent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$vstdate) {
        $this->findModel($id)->delete();
        $connection = Yii::$app->db5;
        
        $command = Yii::$app->db5->createCommand("SELECT tcount FROM oapp_show WHERE vstdate='$vstdate' ");
        $tcount = $command->queryScalar();
        
        
        if($tcount<2){
           $datal3 = $connection->createCommand("DELETE FROM oapp_show  WHERE vstdate ='$vstdate' ")->execute();  
        }else{
          $datal3 = $connection->createCommand("UPDATE oapp_show SET tcount=tcount-1  WHERE vstdate ='$vstdate' ")->execute();  
        }
        
        

        return $this->redirect(['index']);
    }

    /**
     * Finds the OappEvent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OappEvent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = OappEvent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
