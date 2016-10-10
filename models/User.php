<?php

namespace app\models;

use yii\base\NotSupportedException;
use Yii;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'email', 'pass', 'firstname', 'lastname', 'registered', 'authKey', 'accessToken', 'username'], 'required'],
            [['company_id', 'role', 'status'], 'integer'],
            [['registered'], 'safe'],
            [['email', 'pass', 'firstname', 'lastname', 'authKey', 'accessToken', 'username', 'phone_number'], 'string', 'max' => 255],
            [['company_id'], 'unique'],
            [['email'], 'unique'],
            [['role'], 'unique'],
            [['firstname'], 'unique'],
            [['lastname'], 'unique'],
            [['status'], 'unique'],
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
            'email' => 'Email',
            'pass' => 'Pass',
            'role' => 'Role',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'registered' => 'Registered',
            'status' => 'Status',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'username' => 'Username',
            'phone_number' => 'Phone Number'
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'company_id' => \Yii::$app->params['companyId']]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token, 'company_id' => \Yii::$app->params['companyId']]);
        //throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'company_id' => \Yii::$app->params['companyId']]);
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'company_id' => \Yii::$app->params['companyId']]);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->pass);
    }

    public function validateUniqueCompanyPassword($password)
    {
        $rows = UserMeta::find()
            ->select('user_id')
            ->from('{{%user_meta}}')
            ->where(['meta_key' => 'unique_company_pass', 'company_id' => \Yii::$app->params['companyId'], 'meta_value' => $password])
            ->one();
        return $rows;
    }

    public static function getVipUsers() {
        $rows = UserMeta::find()
                        ->select('user_id')
                        ->from('{{%user_meta}}')
                        ->where(['meta_key' => 'vip_user', 'company_id' => \Yii::$app->params['companyId'], 'meta_value' => '1'])
                        ->all();

        $ids = array();
        foreach($rows as $val) {
            $ids[] = $val->user_id;
        }

        return self::find()
            ->select('id, firstname, lastname')
            ->where(['company_id' => \Yii::$app->params['companyId'], 'id' => $ids])
            ->all();
    }
}
