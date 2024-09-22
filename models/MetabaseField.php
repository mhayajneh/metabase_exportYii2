<?php

namespace app\models;

use yii\db\ActiveRecord;

class MetabaseField extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%metabase_field}}';
    }

    public function rules()
    {
        return [
            [['name', 'table_id'], 'required'],
            [['table_id'], 'integer'],
            [['description', 'settings'], 'string'],
            [['name', 'type'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'table_id' => 'Table ID',
            'type' => 'Type',
            'settings' => 'Settings',
        ];
    }

    public function getTable()
    {
        return $this->hasOne(MetabaseTable::class, ['id' => 'table_id']);
    }
}
