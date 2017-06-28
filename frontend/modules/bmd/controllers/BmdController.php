<?php

namespace frontend\modules\bmd\controllers;

use Yii;
use app\modules\bmd\models\Bonemass;
use app\modules\bmd\models\BonemassSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BmdController implements the CRUD actions for Bonemass model.
 */
class BmdController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
     * Lists all Bonemass models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BonemassSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Bonemass model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Bonemass model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Bonemass();
        
        $hn= $_GET['hn'];
        $vn= $_GET['vn'];
        $vstdate= $_GET['vstdate'];
        $date1= $_GET['date1'];
        $date2= $_GET['date2'];
        $id = $_GET['id'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/bmd','date1'=>$date1,'date2'=>$date2]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,'vn' => $vn, 'hn' => $hn, 'vstdate' => $vstdate,
                'date1'=>$date1,
                'date2'=>$date2,
                'id'=>$id,
            ]);
        }
    }

    /**
     * Updates an existing Bonemass model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Bonemass model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Bonemass model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bonemass the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bonemass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
