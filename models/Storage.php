<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%storage}}".
 *
 * @property string $id
 * @property string $company_id
 * @property string $user_id
 * @property string $goods_id
 * @property string $amount
 * @property string $arrive
 * @property integer $onsale
 * @property integer $provider_id
 */
class Storage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%storage}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'user_id', 'goods_id', 'arrive'], 'required'],
            [['company_id', 'user_id', 'goods_id', 'onsale', 'provider_id'], 'integer'],
            [['amount'], 'number'],
            [['arrive'], 'safe'],
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
            'amount' => 'Amount',
            'arrive' => 'Arrive',
            'onsale' => 'Onsale',
            'provider_id' => 'Provider ID',
        ];
    }

    public static function getAllGoodsIds($onSale = 1) {
        return static::find()
            ->select(['goods_id'])
            ->where(['onsale' => $onSale, 'company_id' => \Yii::$app->params['companyId']])
            ->andWhere(['not', "amount = 0"])
            ->groupBy(['goods_id'])
            ->all();
    }

    public function addGoods($rows) {
        $ids = array();
        $newRows = array();
        foreach($rows as $val) {
            $ids[] = $val['id'];
            $newRows[$val['id']] = $val;
        }

        $goodsList = $this->findAll(['goods_id' => $ids]);
        $newGoodsList = array();
        foreach($goodsList as $val) {
            $goodsItem = array();
            foreach($val as $key => $val) {
                $goodsItem[$key] = $val;
            }
            $newGoodsList[] = $goodsItem;
        }

        foreach($newGoodsList as $key => $val) {
            if($newGoodsList[$key]['amount'] != -1) {
                $newGoodsList[$key]['amount'] -= $newRows[$newGoodsList[$key]['goods_id']]['amount'];
            }
        }

        $this->deleteAll(['goods_id' => $ids]);

        Yii::$app->db->createCommand()->batchInsert(self::tableName(), $this->attributes(), $newGoodsList)->execute();
    }
}
