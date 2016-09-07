<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%goods}}".
 *
 * @property string $id
 * @property string $company_id
 * @property string $code
 * @property string $name
 * @property string $pic
 * @property string $price
 * @property string $percent
 * @property string $sell_price
 * @property string $category_id
 * @property string $unit
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'name', 'pic', 'price', 'sell_price', 'category_id'], 'required'],
            [['company_id', 'category_id'], 'integer'],
            [['price', 'percent', 'sell_price'], 'number'],
            [['code', 'name', 'pic'], 'string', 'max' => 255],
            [['unit'], 'string', 'max' => 50],
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
            'code' => 'Code',
            'name' => 'Name',
            'pic' => 'Pic',
            'price' => 'Price',
            'percent' => 'Percent',
            'sell_price' => 'Sell Price',
            'category_id' => 'Category ID',
            'unit' => 'Unit',
        ];
    }

    public static function getAllGoodsByIds($ids) {
        $idsWhere = ['or'];
        for($i = 0; $i < count($ids); $i++) {
            $idsWhere[] = 'id=' . $ids[$i]['goods_id'];
        }
        return static::find()
            ->where(['and', 'company_id' => \Yii::$app->params['companyId'], $idsWhere])
            ->all();
    }
}
