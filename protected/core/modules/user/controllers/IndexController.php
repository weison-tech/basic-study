<?php
namespace core\modules\user\controllers;

use Yii;
use yii\web\Controller;
use core\modules\user\forms\LoginForm;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class IndexController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'user' => 'user',
                'rules' => [
                    [
                        'actions' => ['login', 'register', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => [],
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
     * Home Index
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * User login
     */
    public function actionLogin()
    {
        $this->layout = 'main-login';
        if (!Yii::$app->admin->isGuest) {
            return $this->redirect(['index']);
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $returnUrl = Yii::$app->admin->returnUrl;
            if ($returnUrl == '/index.php') {
                $returnUrl = Url::to(['index']);
            }
            return $this->redirect($returnUrl);
        } else {
            return $this->render('login', [
                'model' => $model
            ]);
        }
    }

    /**
     * User logout
     */
    public function actionLogout()
    {
        Yii::$app->admin->logout();
        return $this->redirect(['login']);
    }

    public function actionRegister()
    {

    }
}
