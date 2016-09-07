<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%provider}}".
 *
 * @property string $id
 * @property integer $company_id
 * @property string $name
 * @property string $phone
 */
class Provider extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%provider}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'name', 'phone'], 'required'],
            [['company_id'], 'integer'],
            [['name', 'phone'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'phone' => 'Phone',
        ];
    }
}
