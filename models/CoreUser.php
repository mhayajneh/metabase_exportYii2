<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "core_user".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 */
class CoreUser extends ActiveRecord
{
    public static function tableName()
    {
        return 'core_user';
    }

    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            [['name', 'email'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
        ];
    }
}