<?php

namespace app\controllers;

use app\models\Category;
use app\models\Goods;
use app\models\Returns;
use app\models\Sold;
use app\models\Storage;
use app\models\User;
use app\models\UserMeta;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
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
                    //'logout' => ['post'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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
        $systemLogin = $this->checkSystemLogin();

        if(!$systemLogin) {
            return $this->render('systemlogin');
        }

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array('site/login'));
        }

        $categories = new Category();
        $goodsIds = Storage::getAllGoodsIds();
        $goods = count($goodsIds) ? Goods::getAllGoodsByIds($goodsIds) : array();
        $vipUsersList = User::getVipUsers();

        return $this->render('index', array('categoryList' => $categories->getAll(), 'goodsList' => $goods, 'vipUsersList' => $vipUsersList));
    }

    public function actionAddbasket()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array('site/error'));
        }

        $request = Yii::$app->request;
        $requestBasket = $request->post('requestBasket');
        $requestBasket = json_decode($requestBasket);
        $result = [];
        $sold = new Sold();
        $return = new Returns();

        $rows = array();
        $returnRows = array();
        foreach($requestBasket as $val) {
            if(isset($val->isReturn)) {
                foreach($val->basket as $id => $amount) {
                    $returnRows[] = array('id' => $id, 'amount' => $amount, 'date' => $val->date, 'note' => $val->note, 'userId' => $val->userId);
                }
            } else {
                foreach($val->basket as $id => $amount) {
                    $rows[] = array('id' => $id, 'amount' => $amount, 'date' => $val->date, 'type' => $val->type, 'userId' => $val->userId);
                }
            }

            $result[] = array('date' => $val->date, 'saved' => $val->saved);
        }


        $return->addGoods($returnRows);

        $sold->addGoods($rows);

        return \yii\helpers\Json::encode($result);
    }

    public function actionSystemlogin() {
        $systemLogin = $this->checkSystemLogin();

        if ($systemLogin) {
            return $this->goHome();
        }

        $result = array('status' => false, 'error' => '', 'access' => '');
        $post = Yii::$app->request->post('systemLogin');
        $user = User::findByEmail($post['email']);

        if(!empty($user) && Yii::$app->getSecurity()->validatePassword($post['password'], $user->pass)) {
            $result['status'] = true;
            $result['access'] = $this->getSystemLoginHash($user);
        }

        return \yii\helpers\Json::encode($result);
    }

    private function getSystemLoginHash($user) {
        return $user->id . 'id' . md5($user->id . 'id' . $user->email . $user->email . $user->registered);
    }

    private function checkSystemLogin() {
        $cookies = $_COOKIE || array();
        $systemLogin = isset($cookies['systemLogin']) ? $cookies['systemLogin'] : false;

        if($systemLogin) {
            $systemLoginId = (int)addslashes(trim(substr($systemLogin, 0, strpos($systemLogin, 'id'))));
            $user = User::findIdentity($systemLoginId);

            if(!empty($user)) {
                $systemLoginHash = $this->getSystemLoginHash($user);
                $systemLogin = $systemLogin === $systemLoginHash;
            } else {
                $systemLogin = false;
            }


        }

        return $systemLogin;
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $systemLogin = $this->checkSystemLogin();

        if (!$systemLogin || !Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        //print_r(Yii::$app->request->post());exit;

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
        /*
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);*/
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('login');
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
