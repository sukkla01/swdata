<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                        [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                        [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        $sql = "SELECT * FROM chart_canernew WHERE tyear BETWEEN (YEAR(CURDATE())+543)-5 AND (YEAR(CURDATE())+543)";
        $connection = Yii::$app->db;
        $data = $connection->createCommand($sql)
                ->queryAll();

        for ($i = 0; $i < sizeof($data); $i++) {
            $tyear[] = $data[$i]['tyear'] * 1;
            $tcount[] = $data[$i]['tcount'] * 1;
            //$m2[] = $data[$i]['m2'] * 1;
        }

        //chart cancer type
        $tsql = "SELECT tyear,
                    SUM(IF(type ='1',tcount,0)) AS tone,
                    SUM(IF(type ='2',tcount,0)) AS ttwo,
                    SUM(IF(type ='3',tcount,0)) AS ttree,
                    SUM(IF(type ='4',tcount,0)) AS tfour,
                    SUM(IF(type ='5',tcount,0)) AS tfive 
                    FROM swdata.chart_canertype t
                    GROUP BY tyear";
        
        
        $datat = $connection->createCommand($tsql)
                ->queryAll();

        for ($i = 0; $i < sizeof($datat); $i++) {
            $tone[] = $datat[$i]['tone'] * 1;
            $ttwo[] = $datat[$i]['ttwo'] * 1;
            $ttree[] = $datat[$i]['ttree'] * 1;
            $tfour[] = $datat[$i]['tfour'] * 1;
            $tfive[] = $datat[$i]['tfive'] * 1;
            //$m2[] = $data[$i]['m2'] * 1;
        }
        
        //chart cancer spclty cancer
        $sql58 = "SELECT tyear,
                    SUM(IF(type ='1',tcount,0)) AS tone,
                    SUM(IF(type ='2',tcount,0)) AS ttwo,
                    SUM(IF(type ='3',tcount,0)) AS ttree,
                    SUM(IF(type ='4',tcount,0)) AS tfour,
                    SUM(IF(type ='5',tcount,0)) AS tfive 
                    FROM swdata.chart_canertype_dept t
                    GROUP BY tyear";
        
        
        $data58 = $connection->createCommand($sql58)
                ->queryAll();

        for ($i = 0; $i < sizeof($data58); $i++) {
            $one58[] = $data58[$i]['tone'] * 1;
            $two58[] = $data58[$i]['ttwo'] * 1;
            $tree58[] = $data58[$i]['ttree'] * 1;
            $four58[] = $data58[$i]['tfour'] * 1;
            $five58[] = $data58[$i]['tfive'] * 1;
            //$m2[] = $data[$i]['m2'] * 1;
        }
        
        
        
        
        try {
            $rawData = \Yii::$app->db->createCommand($tsql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => false
        ]);
        //$tyear1[]=['2555','2556','2557','2558','25556'];
        //$tcount1[]=[10,22,33,44,55];
        return $this->render('index', ['tyear' => $tyear, 'tcount' => $tcount,'dataProvider' => $dataProvider,
                              'tone'=>$tone,'ttwo'=>$ttwo,'ttree'=>$ttree,'tfour'=>$tfour,'tfive'=>$tfive,
                               'one58'=>$one58,'two58'=>$two58,'tree58'=>$tree58,'four58'=>$four58,'five58'=>$five58]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

}
