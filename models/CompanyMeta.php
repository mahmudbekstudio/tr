<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%company_meta}}".
 *
 * @property string $id
 * @property integer $company_id
 * @property string $meta_key
 * @property string $meta_value
 */
class CompanyMeta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%company_meta}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'meta_key', 'meta_value'], 'required'],
            [['company_id'], 'integer'],
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
            'meta_key' => 'Meta Key',
            'meta_value' => 'Meta Value',
        ];
    }
}
