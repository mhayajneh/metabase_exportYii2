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
            [['name', 'db'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['db'], 'integer'],
        ];
    }

    public function getFields()
    {
        return $this->hasMany(MetabaseField::class, ['table_id' => 'id']);
    }

    public function getDatabase()
    {
        return $this->hasOne(MetabaseDatabase::class, ['id' => 'db']);
    }
}
