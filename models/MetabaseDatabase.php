<?php

namespace app\models;

use yii\db\ActiveRecord;

class MetabaseDatabase extends ActiveRecord
{
    public $existing_database_id;
    public $new_database_name;


    public static function tableName()
    {
        return '{{%metabase_database}}';
    }

    public function rules()
    {
        return [
            [['existing_database_id', 'new_database_name'], 'required'],
            ['existing_database_id', 'integer'],
            ['new_database_name', 'string', 'max' => 255],
            [['name'], 'required'],
            [['details', 'description'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'details' => 'Details',
            'description' => 'Description',
        ];
    }

    public function getTables()
    {
        return $this->hasMany(MetabaseTable::class, ['db' => 'id']);
    }
}
