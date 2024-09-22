<?php

namespace app\models;

use yii\db\ActiveRecord;

class MetabaseTable extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%metabase_table}}';
    }

    public function rules()
    {
        return [
            [['name', 'database_id'], 'required'],
            [['database_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'database_id' => 'Database ID',
            'description' => 'Description',
        ];
    }

    public function getFields()
    {
        return $this->hasMany(MetabaseField::class, ['table_id' => 'id']);
    }

    public function getDatabase()
    {
        return $this->hasOne(MetabaseDatabase::class, ['id' => 'database_id']);
    }
}
