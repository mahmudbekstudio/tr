<?php

namespace app\models;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $company_id;
    public $email;
    public $pass;
    public $role;
    public $firstname;
    public $lastname;
    public $registered;
    public $status;

    public $username;
    public $authKey;
    public $accessToken;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return self::findById($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $rows = (new \yii\db\Query())
            ->select(['*'])
            ->from(\Yii::$app->db->tablePrefix . 'user')
            ->where(['accessToken' => $token])
            ->all();
        if(empty($rows)) {
            $result = null;
        } else {
            $result = new static($rows[0]);
        }
        return $result;
        /*foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }*/

        //return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    public static function findById($id)
    {
        $rows = (new \yii\db\Query())
            ->select(['*'])
            ->from(\Yii::$app->db->tablePrefix . 'user')
            ->where(['id' => $id])
            ->all();

        if(empty($rows)) {
            $result = false;
        } else {
            $result = new static($rows[0]);
        }
        return $result;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function validateUniqueCompanyPassword($password)
    {
        $rows = (new \yii\db\Query())
            ->select(['user_id'])
            ->from(\Yii::$app->db->tablePrefix . 'user_meta')
            ->where(['meta_key' => 'unique_company_' . \Yii::$app->params['companyId'] . '_pass', 'meta_value' => $password])
            ->all();
        if(empty($rows)) {
            $result = false;
        } else {
            $result = $rows[0];
        }

        return $result;
    }
}
