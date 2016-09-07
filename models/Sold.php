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
 * @property string $amount
 * @property string $sold_date
 * @property string $paid
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
            [['company_id', 'user_id', 'goods_id', 'amount', 'paid_type'], 'required'],
            [['company_id', 'user_id', 'goods_id'], 'integer'],
            [['amount'], 'number'],
            [['sold_date'], 'safe'],
            [['paid'], 'string', 'max' => 2],
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
            'sold_date' => 'Sold Date',
            'paid' => 'Paid',
            'paid_type' => 'Paid type',
        ];
    }
}
