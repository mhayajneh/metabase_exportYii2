<?php

namespace app\models;

use yii\base\Model;

class CloneForm extends Model
{
    public $source_db_id;
    public $new_db_name;

    public function rules()
    {
        return [
            [['source_db_id', 'new_db_name'], 'required'],
            ['source_db_id', 'integer'],
            ['new_db_name', 'string', 'max' => 255],
            ['new_db_name', 'unique', 'targetClass' => MetabaseDatabase::class, 'attributeName' => 'name', 'message' => 'This name is already taken.'],
        ];
    }
}
