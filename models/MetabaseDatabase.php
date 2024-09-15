<?php

namespace app\models;

use yii\db\ActiveRecord;

class MetabaseDatabase extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%metabase_database}}';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function getTables()
    {
        return $this->hasMany(MetabaseTable::class, ['db' => 'id']);
    }
}
