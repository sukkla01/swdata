<?php

namespace frontend\modules\foodhos\controllers;

use Yii;
use app\models\FoodDetail01;
use app\models\FoodDetail01Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FoodaddController implements the CRUD actions for FoodDetail01 model.
 */
class FoodaddController extends \common\components\AppController  {

    /**
     * @inheritdoc
     */
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
     * Lists all FoodDetail01 models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new FoodDetail01Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FoodDetail01 model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FoodDetail01 model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $this->permitRole([1, 3]);
        $connection = Yii::$app->db2;
        $model = new FoodDetail01();

        $an = $_GET['an'];
        $bed = $_GET['bed'];
        $tname = '';
        $hn = '';
        $ptname = '';
        $aa = 0;
        $anl = '';
        /// -------------- delete -------------------
        if (isset($_GET['foodid']) and ($_GET['tstatus'])=='d') {
            $foodid = $_GET['foodid'];
            $data1 = $connection->createCommand("DELETE FROM food_detail_01 WHERE foodid = '$foodid' ")->execute();
        }
        //---------------- edit --------------------
        if (isset($_GET['foodid']) and ($_GET['tstatus'])=='d') {
            $foodid = $_GET['foodid'];
           $sql="";
        }

        //----------------------- ข้อมูลทั่วไป -------------
        $sql = "select i.an,i.hn,CONCAT(p.pname,p.fname,' ',p.lname)  AS tname,
                t.name AS ptname,i.ward
                from  ipt i
                LEFT JOIN patient p ON p.hn=i.hn
                LEFT JOIN pttype t ON t.pttype = i.pttype
                WHERE an='$an' ";

        $data = $connection->createCommand($sql)
                ->queryAll();
        for ($i = 0; $i < sizeof($data); $i++) {
            $tname = $data[$i]['tname'];
            $hn = $data[$i]['hn'];
            $ptname = $data[$i]['ptname'];
            $ward = $data[$i]['ward'];
        }


        // ------------ food history -----------
        $sqlhis = "SELECT foodid,fooddate,foodtime,f.an,f.hn,
                    w.name AS wname,f.icode,n.name AS nname,staff,bedno,
                    Congenital_disease,comment,bd,cal
                    FROM food_detail_01 f
                    LEFT JOIN nutrition_items n ON n.icode = f.icode
                    LEFT JOIN ward w ON w.ward = f.ward
                    LEFT JOIN iptadm a ON a.an = f.an
                    WHERE f.an ='$an'
                    ORDER BY fooddate DESC  ";
        try {
            $rawData = \Yii::$app->db2->createCommand($sqlhis)->queryAll();
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


        //--------- food last ---------
        if (Yii::$app->request->isPost) {
            $r = $_POST['FoodDetail01'];
            $hn_l = $r['hn'];
            $an_l = $r['an'];
            $icode_last = $r['icode'];
            $fooddate_last = $r['fooddate'];

            $sqllast = "SELECT * FROM swdata.food_last WHERE an ='$an'";
            $datalast = $connection->createCommand($sqllast)
                    ->queryAll();
            for ($it = 0; $it < sizeof($datalast); $it++) {
                $anl = $datalast[$it]['an'];
            }
            if ($anl == '') {
                $datals = $connection->createCommand("INSERT INTO swdata.food_last VALUES ('$hn_l','$an_l','$icode_last','$fooddate_last')")->execute();
            } else {
                $datals = $connection->createCommand("UPDATE swdata.food_last SET icode='$icode_last',fooddate_last='$fooddate_last' WHERE an='$an_l' ")->execute();
            }
        }


        // -------------------- save --------------------------
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['/foodhos', 'ward' => $ward]);
            return $this->redirect(['success', 'ward' => $ward,
                        'an' => $an, 'bed' => $bed, 'tname' => $tname,
                        'hn' => $hn, 'ptname' => $ptname,]);
        } else {
            return $this->render('create', [
                        'dataProvider' => $dataProvider,
                        'model' => $model,
                        'an' => $an, 'bed' => $bed, 'tname' => $tname,
                        'hn' => $hn, 'ptname' => $ptname, 'ward' => $ward
            ]);
        }
    }

    /**
     * Updates an existing FoodDetail01 model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->foodid]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FoodDetail01 model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FoodDetail01 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FoodDetail01 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = FoodDetail01::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPrint($id) {
        return $this->render(['print', []]);
    }

    public function actionSuccess() {
        
        $this->permitRole([1, 3]);
        $ward = $_GET['ward'];
        $hn = $_GET['hn'];
        $an = $_GET['an'];
        $bed = $_GET['bed'];
        $tname = $_GET['tname'];
        return $this->render('success', [
                    'ward' => $ward,
                        'an' => $an, 'bed' => $bed, 'tname' => $tname,
                        'hn' => $hn,
        ]);
    }

}
