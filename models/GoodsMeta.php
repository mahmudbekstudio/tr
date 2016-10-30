<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%goods_meta}}".
 *
 * @property string $id
 * @property string $company_id
 * @property string $goods_id
 * @property string $meta_key
 * @property string $meta_value
 */
class GoodsMeta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_meta}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'goods_id', 'meta_key', 'meta_value'], 'required'],
            [['company_id', 'goods_id'], 'integer'],
            [['meta_value'], 'string'],
            [['meta_key'], 'string', 'max' => 255],
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
            'goods_id' => 'Goods ID',
            'meta_key' => 'Meta Key',
            'meta_value' => 'Meta Value',
        ];
    }
}
