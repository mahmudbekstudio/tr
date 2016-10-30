<?php

namespace app\controllers;

use app\models\Category;
use app\models\Goods;
use app\models\GoodsCategory;
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
        $goodsCategory = GoodsCategory::getCategoryList($goodsIds);
        $goodsStorage = Storage::getGoodsForSale($goodsIds);

        $goodsStorageList = $this->listToArray($goodsStorage, array(), 'goods_id');

        $categoryArr = array();
        foreach($goodsCategory as $val) {
            if(!isset($categoryArr[$val['goods_id']])) {
                $categoryArr[$val['goods_id']] = array();
            }

            $categoryArr[$val['goods_id']][] = $val['category_id'];
        }

        //print_r(Goods::getAllGoodsByIds($goodsIds));exit;

        $goods = $this->listToArray(count($goodsIds) ? Goods::getAllGoodsByIds($goodsIds) : array(), array('meta'), 'id');
        foreach($goods as $id => $goodsItem) {
            $goods[$id]['category'] = isset($categoryArr[$id]) ? $categoryArr[$id] : array();
            $goods[$id]['amount'] = $goodsStorageList[$id]['amount'];
            $goods[$id]['provider_id'] = $goodsStorageList[$id]['provider_id'];

            if(isset($goods[$id]['meta'])) {
                $newMeta = array();
                foreach($goods[$id]['meta'] as $meta) {
                    if(!isset($newMeta[$meta['meta_key']])) {
                        $newMeta[$meta['meta_key']] = array();
                    }
                    $newMeta[$meta['meta_key']][] = $meta['meta_value'];
                }
                $goods[$id]['meta'] = $newMeta;
            }

            $goods[$id]['unit_type_list'] = array();
            if($goods[$id]['unit_type'] != '') {
                $typesList = explode('::', $goods[$id]['unit_type']);
                foreach($typesList as $type) {
                    $newType = array();
                    $eqType = explode('=', $type);
                    $newType['sellCount'] = isset($eqType[1]) ? $eqType[1] : 1;

                    $devideType = explode('/', $eqType[0]);
                    if(count($devideType) == 2) {
                        $newType['opration'] = '/';
                        $newType['operand'] = $devideType[1] != '' ? $devideType[1] : 1;
                        $newType['type'] = $devideType[0];
                    } else {
                        $multiplyType = explode('*', $eqType[0]);
                        $newType['opration'] = '*';
                        $newType['operand'] = !isset($multiplyType[1]) || $multiplyType[1] == '' ? 1 : $multiplyType[1];
                        $newType['type'] = $multiplyType[0];
                    }

                    $goods[$id]['unit_type_list'][] = $newType;
                }
            } else {
                $goods[$id]['unit_type_list'][] = array('opration' => '*', 'operand' => '1', 'type' => 'packaging');
            }
        }

        $vipUsersList = User::getVipUsers();

        $categoryList = array();
        $categoryListAll = $categories->getAll();
        for($i = 0; $i < count($categoryListAll); $i++) {
            $categoryList[$categoryListAll[$i]['id']] = $categoryListAll[$i];
        }

        return $this->render('index', array('categoryList' => $categoryList, 'goodsList' => $goods, 'vipUsersList' => $vipUsersList));
    }

    private function listToArray($list, $params = array(), $index = false) {
        $result = array();

        foreach($list as $val) {
            $itemVal = array();
            if(is_array($val) || is_object($val)) {
                foreach($val as $subKey => $subVal) {
                    $itemVal[$subKey] = $subVal;
                }
                foreach($params as $param) {
                    foreach($val[$param] as $valItem) {
                        $newItem = array();
                        foreach($valItem as $subKey => $subVal) {
                            $newItem[$subKey] = $subVal;
                        }
                        $itemVal[$param][] = $newItem;
                    }
                }
            } else {
                $itemVal = $val;
            }

            if($index !== false) {
                $result[$val[$index]] = $itemVal;
            } else {
                $result[] = $itemVal;
            }
        }

        return $result;
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
            if(isset($val->basket) && isset($val->date) && isset($val->userId)) {
                $val->provider_goods_id = isset($val->provider_goods_id) ? $val->provider_goods_id : 0;
                if(isset($val->isReturn)) {
                    foreach($val->basket as $id => $amount) {
                        $returnRows[] = array('id' => $id, 'provider_goods_id' => $val->provider_goods_id, 'amount' => $amount, 'date' => $val->date, 'note' => $val->note, 'userId' => $val->userId);
                    }
                } else {
                    foreach($val->basket as $id => $amount) {
                        $rows[] = array('id' => $id, 'provider_goods_id' => $val->provider_goods_id, 'amount' => $amount, 'date' => $val->date, 'type' => $val->type, 'userId' => $val->userId);
                    }
                }

                $result[] = array('date' => $val->date, 'saved' => $val->saved);
            }
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
        $cookies = $_COOKIE;
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
