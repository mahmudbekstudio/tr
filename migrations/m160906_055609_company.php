<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m160906_055609_company extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }


        $this->createTable('{{%company}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' unsigned NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'lang' =>  Schema::TYPE_STRING . ' NOT NULL',
        ], $tableOptions);
        $this->createIndex('user_id', '{{%company}}', 'user_id', true);
        $this->createIndex('lang', '{{%company}}', 'lang', true);

        $this->createTable('{{%company_meta}}', [
            'id' => Schema::TYPE_PK,
            'company_id' => Schema::TYPE_INTEGER . ' unsigned NOT NULL',
            'meta_key' => Schema::TYPE_STRING . ' NOT NULL',
            'meta_value' =>  Schema::TYPE_TEXT . ' NOT NULL',
        ], $tableOptions);
        $this->createIndex('company_id', '{{%company_meta}}', 'company_id', true);
        $this->createIndex('meta_key', '{{%company_meta}}', 'meta_key', true);
    }

    public function down()
    {
        $this->dropTable('{{%company}}');
        $this->dropTable('{{%company_meta}}');

        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
