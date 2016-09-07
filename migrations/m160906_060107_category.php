<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m160906_060107_category extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'id' => Schema::TYPE_PK,
            'company_id' => Schema::TYPE_INTEGER . ' unsigned NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'parent_id' =>  Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        $this->createIndex('company_id', '{{%category}}', 'company_id', true);
        $this->createIndex('name', '{{%category}}', 'name', true);
        $this->createIndex('parent_id', '{{%category}}', 'parent_id', true);
    }

    public function down()
    {
        $this->dropTable('{{%category}}');

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
