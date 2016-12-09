<?php

namespace backend\controllers;

use Yii;
use app\models\FingerDownload;
use app\models\FingerDownloadSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * FingerController implements the CRUD actions for FingerDownload model.
 */
class FingerController extends Controller {

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
     * Lists all FingerDownload models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new FingerDownloadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FingerDownload model.
     * @param string $year
     * @param string $month
     * @return mixed
     */
    public function actionView($year, $month) {
        return $this->render('view', [
                    'model' => $this->findModel($year, $month),
        ]);
    }

    /**
     * Creates a new FingerDownload model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new FingerDownload();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->file1 = $this->uploadSingleFile($model);
            $model->file2 = $this->uploadSingleFile2($model);
            $model->file3 = $this->uploadSingleFile3($model);
            $model->file4 = $this->uploadSingleFile4($model);

            return $this->redirect(['view', 'year' => $model->year, 'month' => $model->month]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    private function uploadSingleFile($model, $tempFile = null) {
        $file = [];
        $json = '';
        try {
            $UploadedFile = UploadedFile::getInstance($model, 'file1');
            $year = $model->year;
            $month = $model->month;
            if ($UploadedFile !== null) {
                $oldFileName = $UploadedFile->basename . '.' . $UploadedFile->extension;
                $newFileName = $month . $year . '_1.' . $UploadedFile->extension;
                $UploadedFile->saveAs('../web/fingerfile' . '/' . $newFileName);
                $file[$newFileName] = $oldFileName;
                
                $connection = Yii::$app->db;
                $sql = "UPDATE finger_download SET file1='$newFileName' WHERE year = '$year' AND month = '$month' ";
                $data1 = $connection->createCommand($sql)->execute();

                $json = Json::encode($file);
            } else {
                $json = $tempFile;
            }
        } catch (Exception $e) {
            $json = $tempFile;
        }
        return $json;
    }

    private function uploadSingleFile2($model, $tempFile = null) {
        $file = [];
        $json = '';
        try {
            $UploadedFile = UploadedFile::getInstance($model, 'file2');
            $year = $model->year;
            $month = $model->month;
            if ($UploadedFile !== null) {
                $oldFileName = $UploadedFile->basename . '.' . $UploadedFile->extension;
                $newFileName = $month . $year . '_2.' . $UploadedFile->extension;
                $UploadedFile->saveAs('../web/fingerfile' . '/' . $newFileName);
                $file[$newFileName] = $oldFileName;
                
                $connection = Yii::$app->db;
                $sql = "UPDATE finger_download SET file2='$newFileName' WHERE year = '$year' AND month = '$month' ";
                $data1 = $connection->createCommand($sql)->execute();
                
                $json = Json::encode($file);
            } else {
                $json = $tempFile;
            }
        } catch (Exception $e) {
            $json = $tempFile;
        }
        return $json;
    }
    
     private function uploadSingleFile3($model, $tempFile = null) {
        $file = [];
        $json = '';
        try {
            $UploadedFile = UploadedFile::getInstance($model, 'file3');
            $year = $model->year;
            $month = $model->month;
            if ($UploadedFile !== null) {
                $oldFileName = $UploadedFile->basename . '.' . $UploadedFile->extension;
                $newFileName = $month . $year . '_3.' . $UploadedFile->extension;
                $UploadedFile->saveAs('../web/fingerfile' . '/' . $newFileName);
                $file[$newFileName] = $oldFileName;
                
                $connection = Yii::$app->db;
                $sql = "UPDATE finger_download SET file3='$newFileName' WHERE year = '$year' AND month = '$month' ";
                $data1 = $connection->createCommand($sql)->execute();
                
                $json = Json::encode($file);
            } else {
                $json = $tempFile;
            }
        } catch (Exception $e) {
            $json = $tempFile;
        }
        return $json;
    }
    
     private function uploadSingleFile4($model, $tempFile = null) {
        $file = [];
        $json = '';
        try {
            $UploadedFile = UploadedFile::getInstance($model, 'file4');
            $year = $model->year;
            $month = $model->month;
            if ($UploadedFile !== null) {
                $oldFileName = $UploadedFile->basename . '.' . $UploadedFile->extension;
                $newFileName = $month . $year . '_4.' . $UploadedFile->extension;
                $UploadedFile->saveAs('../web/fingerfile' . '/' . $newFileName);
                $file[$newFileName] = $oldFileName;
                
                $connection = Yii::$app->db;
                $sql = "UPDATE finger_download SET file4='$newFileName' WHERE year = '$year' AND month = '$month' ";
                $data1 = $connection->createCommand($sql)->execute();
                
                $json = Json::encode($file);
            } else {
                $json = $tempFile;
            }
        } catch (Exception $e) {
            $json = $tempFile;
        }
        return $json;
    }

    private function CreateDir($folderName) {
        if ($folderName != NULL) {
            $basePath = finger::getUploadPath();
            if (BaseFileHelper::createDirectory($basePath . $folderName, 0777)) {
                BaseFileHelper::createDirectory($basePath . $folderName . '/thumbnail', 0777);
            }
        }
        return;
    }

    /**
     * Updates an existing FingerDownload model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $year
     * @param string $month
     * @return mixed
     */
    public function actionUpdate($year, $month) {
        $model = $this->findModel($year, $month);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'year' => $model->year, 'month' => $model->month]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FingerDownload model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $year
     * @param string $month
     * @return mixed
     */
    public function actionDelete($year, $month) {
        $this->findModel($year, $month)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FingerDownload model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $year
     * @param string $month
     * @return FingerDownload the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($year, $month) {
        if (($model = FingerDownload::findOne(['year' => $year, 'month' => $month])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
