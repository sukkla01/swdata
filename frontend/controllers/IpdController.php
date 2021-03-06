<?php

namespace frontend\controllers;

use Yii;

class IpdController extends \common\components\AppController {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionM17() {
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

        $sql = "SELECT i.hn,i.an,i.dchdate,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,d.icd10,c.name AS cname,
                o.icd9,m.name AS 9name,rw,SUM(sum_price) AS tsum ,a.admday
                FROM  ipt i
                LEFT JOIN iptdiag d ON d.an=i.an
		LEFT JOIN (SELECT * FROM iptoprt group by an ) o ON o.an=i.an
                LEFT JOIN patient p ON p.hn=i.hn
                LEFT JOIN icd101 c ON c.code=d.icd10
                LEFT JOIN icd9cm1 m ON m.code=o.icd9
                INNER JOIN opitemrece t ON t.an=i.an
                LEFT JOIN iptadm a ON a.an=i.an
                WHERE dchdate BETWEEN '$date1' AND '$date2'
                      AND icd10 BETWEEN 'm17' AND 'm179'
                GROUP BY i.an ";
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
        return $this->render('m17', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2, 'sql', $sql]);
    }

    public function actionM17income() {
        $this->permitRole([1, 3]);
        $an = $_GET['an'];
        $sql = "SELECT o.income,i.name AS iname,SUM(sum_price)*1 AS tsum,o.an,o.rxdate
                FROM opitemrece o
                LEFT JOIN income i ON i.income = o.income
                WHERE an='$an'
                GROUP BY income
                ORDER BY income ";
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
        return $this->render('m17income', ['dataProvider' => $dataProvider, 'an' => $an]);
    }
     public function actionM17detail() {
        $this->permitRole([1, 3]);
        $an = $_GET['an'];
        $income = $_GET['income'];
        $sql = "SELECT o.icode,s.name AS sname,o.qty,s.cost,sum_price,o.rxdate
                FROM opitemrece o
                LEFT JOIN income i ON i.income = o.income
                LEFT JOIN s_drugitems s ON s.icode=o.icode
                WHERE an='$an' AND o.income ='$income'";
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
        return $this->render('m17detail', ['dataProvider' => $dataProvider, 'an' => $an,'income'=>$income]);
    }
    

    public function actionH25() {
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

        $sql = "SELECT i.hn,i.an,i.dchdate,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,d.icd10,c.name AS cname,o.icd9,m.name AS 9name,rw,SUM(sum_price) AS tsum ,a.admday
                FROM  ipt i
                LEFT JOIN iptdiag d ON d.an=i.an
                LEFT JOIN iptoprt o ON o.an=i.an
                LEFT JOIN patient p ON p.hn=i.hn
                LEFT JOIN icd101 c ON c.code=d.icd10
                LEFT JOIN icd9cm1 m ON m.code=o.icd9
                INNER JOIN opitemrece t ON t.an=i.an
                LEFT JOIN iptadm a ON a.an=i.an
                WHERE dchdate BETWEEN '$date1' AND '$date2'
                      AND icd10 BETWEEN 'h250' AND 'h269'
                GROUP BY i.an";
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
        return $this->render('h25', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2, 'sql', $sql]);
    }

    public function actionTotalincome() {
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

        $sql = "SELECT o.pttype,p.editmask AS pname,
                SUM(IF(o.income='01',sum_price,0)) AS in1,
                SUM(IF(o.income='02',sum_price,0)) AS in2,
                SUM(IF(o.income='03',sum_price,0)) AS in3,
                SUM(IF(o.income='04',sum_price,0)) AS in4,
                SUM(IF(o.income='05',sum_price,0)) AS in5,
                SUM(IF(o.income='06',sum_price,0)) AS in6,
                SUM(IF(o.income='07',sum_price,0)) AS in7,
                SUM(IF(o.income='08',sum_price,0)) AS in8,
                SUM(IF(o.income='09',sum_price,0)) AS in9,
                SUM(IF(o.income='10',sum_price,0)) AS in10,
                SUM(IF(o.income='11',sum_price,0)) AS in11,
                SUM(IF(o.income='12',sum_price,0)) AS in12,
                SUM(IF(o.income='13',sum_price,0)) AS in13,
                SUM(IF(o.income='14',sum_price,0)) AS in14,
                SUM(IF(o.income='15',sum_price,0)) AS in15,
                SUM(IF(o.income='16',sum_price,0)) AS in16,
                SUM(IF(o.income='17',sum_price,0)) AS in17,
                SUM(sum_price) AS tsum

                FROM opitemrece o
                INNER JOIN ipt i ON i.an=o.an
                LEFT JOIN pttype p ON p.pttype=o.pttype
                WHERE dchdate BETWEEN '$date1' AND '$date2'
                                        AND LENGTH(o.an)=9
                GROUP BY p.editmask";
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
        return $this->render('totalincome', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2, 'sql', $sql]);
    }

    public function actionMakkwa() {
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

        $sql = "SELECT o.an,i.dchdate,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,SUM(sum_price) AS tsum,admday,
                g.rw,adjrw,i.ward,w.name AS wname,icd9,c.name AS cname,g.pdx
                FROM opitemrece o
                INNER JOIN ipt i ON i.an=o.an
                LEFT JOIN patient p ON p.hn=o.hn
                LEFT JOIN iptadm a ON a.an=o.an
                LEFT JOIN ward w ON w.ward=i.ward
                LEFT JOIN iptoprt r ON r.an=o.an
                LEFT JOIN icd9cm1 c ON c.code = r.icd9
                LEFT JOIN an_stat g ON g.an=o.an
                LEFT JOIN icd101 i10 ON i10.code=g.pdx
                WHERE i.dchdate BETWEEN '$date1' AND '$date2'
                GROUP BY o.an
                HAVING tsum > 100000";
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
        return $this->render('makkwa', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2, 'sql', $sql]);
    }

    public function actionTreeday() {
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

        $sql = "SELECT o.an,i.dchdate,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,SUM(sum_price) AS tsum,admday,
                g.rw,adjrw,i.ward,w.name AS wname,IF(icd9 IS NULL,'',icd9) as icd9,IF(c.name IS NULL ,'',c.name) AS cname,g.pdx
                FROM opitemrece o
                INNER JOIN ipt i ON i.an=o.an
                LEFT JOIN patient p ON p.hn=o.hn
                LEFT JOIN iptadm a ON a.an=o.an
                LEFT JOIN ward w ON w.ward=i.ward
                LEFT JOIN iptoprt r ON r.an=o.an
                LEFT JOIN icd9cm1 c ON c.code = r.icd9
                LEFT JOIN an_stat g ON g.an=o.an
                LEFT JOIN icd101 i10 ON i10.code=g.pdx
                WHERE i.dchdate BETWEEN '$date1' AND '$date2'
                      AND admday > 30
                GROUP BY o.an ";
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
        return $this->render('treeday', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2, 'sql', $sql]);
    }

    public function actionUc() {
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

        $sql = "SELECT o.hn,o.vn,o.vstdate,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,SUM(sum_price)  AS tsum,SUM(sum_price)-700 AS kun,
                SUM(IF(o.income IN('03','04','17'),sum_price,0)) AS tdrug,v.pdx,i.name AS iname,CONCAT(h.hosptype,h.name) AS thosp
                FROM  opitemrece o
                LEFT JOIN pttype t ON t.pttype = o.pttype
                LEFT JOIN patient p ON p.hn=o.hn
                LEFT JOIN vn_stat v ON v.vn=o.vn
                LEFT JOIN icd101 i ON i.code=v.pdx
								LEFT JOIN hospcode h ON h.hospcode=v.hospmain
                WHERE o.vstdate BETWEEN '$date1' AND '$date2'
                                        AND editmask IN('UC ในเขต','UC นอกเขต')
                                        AND LENGTH(o.vn) =12
                GROUP BY vn
                HAVING tsum>700 ";
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
        return $this->render('uc', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2, 'sql', $sql]);
    }
    
    public function actionUc2() {
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

       /* $sql = "SELECT o.hn,o.vn,o.vstdate,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,SUM(sum_price)  AS tsum,SUM(sum_price)-700 AS kun,
                SUM(IF(o.income IN('03','04','17'),sum_price,0)) AS tdrug,v.pdx,i.name AS iname,CONCAT(h.hosptype,h.name) AS thosp,
		c.name as sname,(SUM(IF(o.income IN('03','04','17'),sum_price,0)))-700 AS kundrug
                FROM  opitemrece o
                LEFT JOIN pttype t ON t.pttype = o.pttype
                LEFT JOIN patient p ON p.hn=o.hn
                LEFT JOIN vn_stat v ON v.vn=o.vn
                LEFT JOIN icd101 i ON i.code=v.pdx
		LEFT JOIN hospcode h ON h.hospcode=v.hospmain
		LEFT JOIN ovst s ON s.vn= o.vn
		LEFT JOIN spclty c ON c.spclty = s.spclty
                WHERE o.vstdate BETWEEN '$date1' AND '$date2'
                      AND editmask ='UC นอกเขต'
                      AND LENGTH(o.vn) =12
                GROUP BY vn
                HAVING tdrug>700 ";*/
        $sql ="SELECT o.hn,o.vn,o.vstdate,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,SUM(sum_price)  AS tsum,SUM(sum_price)-700 AS kun,
                SUM(IF(o.income IN('03','04','17'),sum_price,0)) AS tdrug,v.pdx,i.name AS iname,CONCAT(h.hosptype,h.name) AS thosp,
		c.name as sname,IF(((SUM(IF(o.income IN('03','04','17'),sum_price,0)))-700)>0,((SUM(IF(o.income IN('03','04','17'),sum_price,0)))-700),0) AS kundrug,
((SUM(IF(o.income IN('03','04','17'),sum_price,0)))-700) as tt
                FROM  opitemrece o
                LEFT JOIN pttype t ON t.pttype = o.pttype
                LEFT JOIN patient p ON p.hn=o.hn
                LEFT JOIN vn_stat v ON v.vn=o.vn
                LEFT JOIN icd101 i ON i.code=v.pdx
		LEFT JOIN hospcode h ON h.hospcode=v.hospmain
		LEFT JOIN ovst s ON s.vn= o.vn
		LEFT JOIN spclty c ON c.spclty = s.spclty
                WHERE o.vstdate BETWEEN '$date1' AND '$date2'
                      AND editmask ='UC นอกเขต'
                      AND LENGTH(o.vn) =12
                GROUP BY vn";
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
        return $this->render('uc2', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2, 'sql', $sql]);
    }

    public function actionDrughome() {
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

        $sql = "SELECT o.icode,d.name AS dname,SUM(o.qty) AS tqty,SUM(sum_price) AS tsum
                FROM opitemrece o
                LEFT JOIN drugitems d ON d.icode=o.icode
                WHERE o.vstdate BETWEEN '$date1' AND '$date2'
                    AND o.pttype IN('20','22') AND o.income ='04'
                GROUP BY o.icode
                ORDER BY tqty DESC";
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 20000
            ],
        ]);
        return $this->render('drughome', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2, 'sql', $sql]);
    }

    public function actionHme() {
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

        $sql = "SELECT i.rxdate,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,
			 o.icode,d.name AS dname,
			 o.qty,d.unitcost,(o.qty*d.unitcost) AS tcost,ipd_price,(o.qty*ipd_price) AS tprice,
			 IF(h.hosptype IS NULL,'',CONCAT(h.hosptype,h.name)) AS thos
                FROM ipt_order_no i
                LEFT JOIN ipt t ON t.an=i.an
                LEFT JOIN opitemrece o ON o.an = i.an AND o.order_no = i.order_no
                LEFT JOIN drugitems d ON d.icode = o.icode
                LEFT JOIN patient p ON p.hn = o.hn
                LEFT JOIN hospcode h ON h.hospcode = t.rfrilct
                where   i.rxdate  BETWEEN '$date1' AND '$date2'
                        AND i.order_type = 'Hme'
                        AND o.icode < 3000000
                        AND dosageform ='INJECTIONS' ";
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
        return $this->render('hme', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2, 'sql', $sql]);
    }
    
    
    public function actionDch15() {
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

        $sql = "SELECT i.dchdate ,i.hn,i.an,DATEDIFF(CURDATE(),i.dchdate)  AS tday,
                CONCAT(p.pname,p.fname,' ',p.lname) AS tname,w.name AS wname,t.name AS dname
                FROM ipt i
                LEFT JOIN an_stat a ON a.an = i.an
                LEFT JOIN iptdiag d ON d.an=i.an
                LEFT JOIN patient p ON p.hn=i.hn
                LEFT JOIN ward w ON w.ward = i.ward
                LEFT JOIN doctor t ON t.code=i.dch_doctor
                WHERE i.dchdate BETWEEN '$date1' AND '$date2'
                                        AND (pdx = '' OR pdx IS NULL)
                HAVING tday >15
                ORDER BY wname";
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
        return $this->render('dch15', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2, 'sql', $sql]);
    }
    
    
    public function actionDrughme22() {
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

        $sql = "SELECT i.hn,i.an,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,o.rxdate,o.icode,d.name AS dname,o.qty,o.sum_price
                FROM ipt i 
                LEFT JOIN ipt_order_no n ON n.an = i.an
                LEFT JOIN opitemrece o ON o.an = i.an AND o.order_no = n.order_no
                LEFT JOIN drugitems d ON d.icode = o.icode
                LEFT JOIN patient p ON p.hn = i.hn
                WHERE i.dchdate BETWEEN '$date1' AND '$date2'
                      AND i.pttype ='22'
                      AND n.order_type ='Hme'
                ORDER By i.an ";
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
        return $this->render('drughme22', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2, 'sql', $sql]);
    }

}
