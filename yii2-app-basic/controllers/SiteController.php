<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function behaviors()
    {


        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
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

    public function beforeAction($action)
    {
        echo "<script> console.log('sitebefore: uniid: $action->uniqueId')</script>";
        if($action->uniqueId == "site/error" ) {
            echo "<script> console.log('aqui:')</script>";
            $this->redirect(['view','id'=>'1']);

            $model = new LoginForm();
            return $this->render('login', ['model' => $model,'id', '1']);

            //return $this->render('view', [            'model' => $this->findModel("1"),        ]);
        }
        return true;
    }

    public function actions()
    {
        echo "<script> console.log('SiteController actions')</script>";
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

    public function actionView($id){
        echo "<script> console.log('SiteController actionview')</script>";
    }

    public function actionIndex()
    {
        echo "<script> console.log('SiteController actionIndex')</script>";
        return $this->render('index');
    }


    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
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

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        $hora =  date("D M j G:i:s T Y");
        return $this->render('about', ['hora' => $hora]);
    }
}
