<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m160905_053308_user extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        //user
        $this->createTable('{{%user}}', [
            'id' => Schema::TYPE_PK,
            'company_id' => Schema::TYPE_INTEGER . ' unsigned NOT NULL',
            'email' => Schema::TYPE_STRING . ' NOT NULL',
            'pass' =>  Schema::TYPE_STRING . ' NOT NULL',
            'role' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'firstname' => Schema::TYPE_STRING . ' NOT NULL',
            'lastname' => Schema::TYPE_STRING . ' NOT NULL',
            'registered' => Schema::TYPE_DATETIME . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'authKey' => Schema::TYPE_STRING . ' NOT NULL',
            'accessToken' => Schema::TYPE_STRING . ' NOT NULL',
            'username' => Schema::TYPE_STRING . ' NOT NULL',
        ], $tableOptions);
        $this->createIndex('company_id', '{{%user}}', 'company_id', true);
        $this->createIndex('email', '{{%user}}', 'email', true);
        $this->createIndex('role', '{{%user}}', 'role', true);
        $this->createIndex('firstname', '{{%user}}', 'firstname', true);
        $this->createIndex('lastname', '{{%user}}', 'lastname', true);
        $this->createIndex('status', '{{%user}}', 'status', true);

        //user_meta
        $this->createTable('{{%user_meta}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' unsigned NOT NULL',
            'meta_key' => Schema::TYPE_STRING . ' NOT NULL',
            'meta_value' =>  Schema::TYPE_TEXT . ' NOT NULL',
        ], $tableOptions);
        $this->createIndex('user_id', '{{%user_meta}}', 'user_id', true);
        $this->createIndex('meta_key', '{{%user_meta}}', 'meta_key', true);

        $this->execute($this->addUserSql());
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%user_meta}}');

        return true;
    }

    public function safeUp()
    {
        //
    }
    private function addUserSql()
    {
        $password = Yii::$app->security->generatePasswordHash('admin');
        $auth_key = Yii::$app->security->generateRandomString();
        $token = Yii::$app->security->generateRandomString() . '_' . time();
        return "INSERT INTO {{%user}} (`company_id`, `email`, `pass`, `role`, `firstname`, `lastname`, `registered`, `status`, `authKey`, `accessToken`, `username`) VALUES ('1', 'mahmudbekstudio@mail.ru', '$password', '0', 'Mahmud', 'Odilov', '2016-08-18 00:00:00', '1', '$auth_key', '$token', 'mahmudbekstudio@mail.ru')";
    }
    public function safeDown()
    {
        //
    }
}
