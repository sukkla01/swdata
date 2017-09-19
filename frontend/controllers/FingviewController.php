<?php

namespace frontend\controllers;

use Yii;

class FingviewController extends  \common\components\AppController {

    public function actionIndex() {
        $this->permitRole([1, 3]);
        $tsql = "SELECT year,name,file1,file2,file3,file4,note1
                FROM finger_download d
                LEFT JOIN finger_month m ON m.code = d.month
                ORDER BY CONCAT(d.year,d.month)  DESC";

        try {
            $rawData = \Yii::$app->db->createCommand($tsql)->queryAll();
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
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionDfile() {

        $name = $_GET['file'];

       // $path = Yii::getAlias('localhost/swdata/backend/web') . '/fingerfile/';
       // $file = $path . $name;

        //$aa = Yii::$app->response->sendFile($file);
        
        $pathFile = 'C:/xampp/htdocs/swdata/backend/web/fingerfile/'.$name;

        $pathFile1 = Yii::getAlias('@webroot').'/fingerfile/012559_1.pdf' ;
       //  $filename = '012559_1.pdf';
        //$path = Yii::getPathOfAlias('webroot') . "/uploads/downloads/23602414.pdf";
       // $this->downloadFile($file);
       //  return $this->render('dfile', ['path' => $pathFile,'path1'=>$pathFile1]);
        //return  Yii::$app->response->sendFile($path, $filename);
       return \Yii::$app->response->sendFile($pathFile);

    }
    public function actionStampjob1() {
        
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
        $sql = "SELECT c.Badgenumber,
                IF(u.username IS NULL,'',u.username) as username,u.name as Fullname,date(c.CHECKTIME) as Tdate,time(c.CHECKTIME) as TTime,d.depjob,d.deptnamenew
                ,m.position,m.ระดับ as Tlevel,
                if (time(CHECKTIME) BETWEEN '04:00:00' and '08:30:00','ในเวลา','สาย') as WrokTime
                from checkinout c
                INNER JOIN USERINFO u on u.Badgenumber=c.Badgenumber
                INNER JOIN memberall m on m.Badgenumber=c.Badgenumber
                INNER JOIN dep d on d.DEPTID=u.DEFAULTDEPTID
                where c.VERIFYCODE='0' 
                and CHECKTIME BETWEEN concat('$date1',' 04:00:00') and  concat('$date2',' 13:30:00')
                GROUP BY c.Badgenumber
                ORDER BY c.checktime ASC";
        try {
            $rawData = \Yii::$app->db4->createCommand($sql)->queryAll();
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
        
        return $this->render('stampjob1', ['dataProvider' => $dataProvider,'date1'=>$date1,'date2'=>$date2]);
    }
    
    public function actionStampjob2() {
        
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
        $sql = "SELECT c.Badgenumber,
                IF(u.username IS NULL,'',u.username) as username
                ,u.name as Fullname,date(c.CHECKTIME) as Tdate,time(c.CHECKTIME) as TTime,d.depjob,d.deptnamenew
                ,m.position,m.ระดับ as Tlevel,
                if (time(CHECKTIME) BETWEEN '13:30:00' and '16:30:00','ในเวลา','สาย') as WrokTime
                from checkinout c
                INNER JOIN USERINFO u on u.Badgenumber=c.Badgenumber
                INNER JOIN memberall m on m.Badgenumber=c.Badgenumber
                INNER JOIN dep d on d.DEPTID=u.DEFAULTDEPTID
                where c.VERIFYCODE='0' 
                and CHECKTIME BETWEEN concat('$date1',' 13:30:00') and  concat('$date2',' 18:30:00')
                GROUP BY c.Badgenumber
                ORDER BY c.checktime ASC ";
                            try {
            $rawData = \Yii::$app->db4->createCommand($sql)->queryAll();
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
        
        return $this->render('stampjob2', ['dataProvider' => $dataProvider,'date1'=>$date1,'date2'=>$date2]);
    }
    public function actionStampjob3() {
        
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
        $sql = "SELECT c.Badgenumber,
                IF(u.username IS NULL,'',u.username) as username
                ,u.name as Fullname,date(c.CHECKTIME) as Tdate,time(c.CHECKTIME) as TTime,d.depjob,d.deptnamenew
                ,m.position,m.ระดับ as Tlevel,
                if (time(CHECKTIME) NOT BETWEEN '00:30:01' and '01:30:00','ในเวลา','สาย') as WrokTime
                from checkinout c
                INNER JOIN USERINFO u on u.Badgenumber=c.Badgenumber
                INNER JOIN memberall m on m.Badgenumber=c.Badgenumber                
                INNER JOIN dep d on d.DEPTID=u.DEFAULTDEPTID
                where c.VERIFYCODE='0' 
                and CHECKTIME BETWEEN concat('$date1',' 23:00:00') and  concat('$date2',' 01:30:00')
                GROUP BY c.Badgenumber
                ORDER BY c.checktime ASC ";
                                            try {
            $rawData = \Yii::$app->db4->createCommand($sql)->queryAll();
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
        
        return $this->render('stampjob3', ['dataProvider' => $dataProvider,'date1'=>$date1,'date2'=>$date2]);
    }

   

}
