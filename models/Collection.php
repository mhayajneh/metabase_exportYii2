<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "collection".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $color
 * @property int|null $parent_id
 * @property bool $archived
 * @property int|null $location
 * @property string|null $slug
 * @property int|null $personal_owner_id
 * @property int|null $authority_level
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Collection extends ActiveRecord
{
    public static function tableName()
    {
        return 'collection';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['color', 'parent_id', 'location', 'personal_owner_id', 'authority_level'], 'integer'],
            [['archived'], 'boolean'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'slug'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'color' => 'Color',
            'parent_id' => 'Parent ID',
            'archived' => 'Archived',
            'location' => 'Location',
            'slug' => 'Slug',
            'personal_owner_id' => 'Personal Owner ID',
            'authority_level' => 'Authority Level',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getParent()
    {
        return $this->hasOne(Collection::class, ['id' => 'parent_id']);
    }

    public function getPersonalOwner()
    {
        return $this->hasOne(CoreUser::class, ['id' => 'personal_owner_id']);
    }
}