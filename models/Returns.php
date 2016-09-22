<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%return}}".
 *
 * @property string $id
 * @property string $company_id
 * @property string $user_id
 * @property string $goods_id
 * @property string $amount
 * @property string $return_date
 * @property string $description
 */
class Returns extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%return}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'user_id', 'goods_id', 'amount', 'return_date', 'description'], 'required'],
            [['company_id', 'user_id', 'goods_id'], 'integer'],
            [['amount'], 'number'],
            [['return_date'], 'safe'],
            [['description'], 'string'],
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
            'return_date' => 'Return Date',
            'description' => 'Description',
        ];
    }

    public function addGoods($rows) {
        $list = array();
        $companyId = \Yii::$app->params['companyId'];
        foreach($rows as $val) {
            $list[] = array(null, $companyId, $val['userId'], $val['id'], $val['amount'], $val['date'], $val['note']);
        }

        Yii::$app->db->createCommand()->batchInsert(self::tableName(), $this->attributes(), $list)->execute();

        $storage = new Storage();
        $storage->addGoods($rows);
    }
}
