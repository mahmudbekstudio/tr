<?php

namespace app\modules\admin\controllers;

use app\models\Goods;
use app\models\Sold;
use app\models\User;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        /*if (Yii::$app->user->isGuest) {
            return $this->redirect(array('admin/login'));
        }*/

        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
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
    }

    public function actionStatistics()
    {
        $goods = new Goods();
        $goodsList = $goods->findAll(['company_id' => \Yii::$app->params['companyId']]);
        $sold = new Sold();
        $soldGoods = $sold->findAll(['company_id' => \Yii::$app->params['companyId']]);
        $user = new User();
        $userList = $user->findAll(['company_id' => \Yii::$app->params['companyId']]);
        $listGoods = array();
        $listSold = array();
        $listUser = array();

        foreach($userList as $item) {
            $listUser[$item->id] = $item;
        }

        foreach($goodsList as $item) {
            $listGoods[$item->id] = $item;
        }

        foreach($soldGoods as $val) {
            $d = date('d.m.Y', $val->sold_date);

            if(!isset($listSold[$d])) {
                $listSold[$d] = array('children' => array(), 'vipList' => array(), 'total' => array('cash' => 0, 'card' => 0, 'vip' => 0));
            }

            $listSold[$d]['children'][] = $val;

            if($val->paid_type == 'cash') {
                $listSold[$d]['total']['cash'] += $val->amount * $listGoods[$val->goods_id]->price;
            } elseif($val->paid_type == 'card') {
                $listSold[$d]['total']['card'] += $val->amount * $listGoods[$val->goods_id]->price;
            } else {
                $listSold[$d]['total']['vip'] += $val->amount * $listGoods[$val->goods_id]->price;
                $vipId = str_replace('vip:', '', $val->paid_type);

                if(!isset($listSold[$d]['vipList'][$vipId])) {
                    $listSold[$d]['vipList'][$vipId] = array('name' => $listUser[$vipId]->firstname . ' ' . $listUser[$vipId]->lastname, 'total' => 0);
                }

                $listSold[$d]['vipList'][$vipId]['total'] += $val->amount * $listGoods[$val->goods_id]->price;
            }
        }

        return $this->render('statistics', ['list' => $listSold]);
    }
}
