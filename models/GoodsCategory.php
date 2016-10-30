<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%goods_category}}".
 *
 * @property string $id
 * @property string $company_id
 * @property string $category_id
 * @property string $goods_id
 */
class GoodsCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'category_id', 'goods_id'], 'required'],
            [['company_id', 'category_id', 'goods_id'], 'integer'],
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
            'category_id' => 'Category ID',
            'goods_id' => 'Goods ID',
        ];
    }

    static public function getCategoryList($ids) {
        $idsWhere = ['or'];

        for($i = 0; $i < count($ids); $i++) {
            $idsWhere[] = "`goods_id`='" . $ids[$i]['goods_id'] . "'";
        }

        return static::find()
                     ->where(['and', "`company_id`='" . \Yii::$app->params['companyId'] . "'" , $idsWhere])
                     ->all();
    }
}
