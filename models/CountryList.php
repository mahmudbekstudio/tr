<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%countryList}}".
 *
 * @property integer $id
 * @property string $country_code
 * @property string $country_name
 */
class CountryList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%country_list}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_code'], 'string', 'max' => 2],
            [['country_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_code' => 'Country Code',
            'country_name' => 'Country Name',
        ];
    }
}
