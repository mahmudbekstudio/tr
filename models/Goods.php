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
            [['company_id', 'name', 'pic', 'price', 'ordering'], 'required'],
            [['company_id'], 'integer'],
            [['price', 'sell_price'], 'number'],
            [['code', 'name', 'pic'], 'string', 'max' => 255],
            [['unit'], 'string', 'max' => 50],
            [['unit_type'], 'string', 'max' => 20],
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
            'unit' => 'Unit',
            'unit_type' => 'Unit Type',
            'ordering' => 'Ordering'
        ];
    }

    public function getMeta() {
        return $this->hasMany(GoodsMeta::className(), ['goods_id' => 'id']);
    }

    public static function getAllGoodsByIds($ids) {
        $idsWhere = ['or'];
        for($i = 0; $i < count($ids); $i++) {
            $idsWhere[] = 'id=' . $ids[$i]['goods_id'];
        }
        return static::find()
            ->with('meta')
            ->where(['and', "`company_id`='" . \Yii::$app->params['companyId'] . "'", $idsWhere])
            ->orderBy(['ordering' => SORT_ASC])
            ->all();
    }
}
