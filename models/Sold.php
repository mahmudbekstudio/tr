<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%sold}}".
 *
 * @property string $id
 * @property string $company_id
 * @property string $user_id
 * @property string $goods_id
 * @property string $provider_goods_id
 * @property string $amount
 * @property string $sold_date
 * @property string $paid_type
 */
class Sold extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sold}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'user_id', 'goods_id', 'provider_goods_id', 'amount', 'paid_type'], 'required'],
            [['company_id', 'user_id', 'goods_id', 'provider_goods_id'], 'integer'],
            [['amount'], 'number'],
            [['sold_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'user_id' => 'User ID',
            'goods_id' => 'Goods ID',
            'provider_goods_id' => 'Provider Goods Id',
            'amount' => 'Amount',
            'sold_date' => 'Sold Date',
            'paid_type' => 'Paid type',
        ];
    }

    public function addGoods($rows) {
        $list = array();
        $companyId = \Yii::$app->params['companyId'];
        $removeFromStorage = array();

        foreach($rows as $val) {
            $removeFromStorage[] = array('goods_id' => $val['id'], 'provider_goods_id' => $val['provider_goods_id'], 'amount' => $val['amount']);
            $list[] = array(null, $companyId, $val['userId'], $val['id'], $val['provider_goods_id'], $val['amount'], $val['date'], $val['type']);
        }

        Yii::$app->db->createCommand()->batchInsert(self::tableName(), $this->attributes(), $list)->execute();

        $storage = new Storage();
        $storage->decrementGoods($removeFromStorage);
    }
}
