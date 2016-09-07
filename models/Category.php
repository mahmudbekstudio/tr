<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property string $id
 * @property string $company_id
 * @property string $name
 * @property string $parent_id
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'name'], 'required'],
            [['company_id', 'parent_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'parent_id' => 'Parent ID',
        ];
    }

    public function findById($id)
    {
        return static::findOne(['id' => $id]);
    }

    public function findByParentId() {
        //
    }

    public function getAll() {
        return static::find()
            ->where(['company_id' => \Yii::$app->params['companyId']])
            ->all();
    }
}
