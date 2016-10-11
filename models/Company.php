<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%company}}".
 *
 * @property string $id
 * @property string $user_id
 * @property string $name
 * @property string $lang
 * @property string $additional_users
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%company}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'lang'], 'required'],
            [['user_id'], 'integer'],
            [['name', 'additional_users'], 'string', 'max' => 250],
            [['lang'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'lang' => 'Lang',
            'additional_users' => 'Additional Users',
        ];
    }
}
