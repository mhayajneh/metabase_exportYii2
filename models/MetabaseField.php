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
            [['name'], 'string', 'max' => 255],
            [['table_id'], 'integer'],
        ];
    }

    public function getTable()
    {
        return $this->hasOne(MetabaseTable::class, ['id' => 'table_id']);
    }
}
