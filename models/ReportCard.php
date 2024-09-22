<?php

namespace app\models;

use yii\db\ActiveRecord;

class ReportCard extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%report_card}}';
    }

    public function rules()
    {
        return [
            [['name', 'database_id'], 'required'],
            [['description', 'dataset_query', 'visualization_settings', 'result_metadata'], 'string'],
            [['creator_id', 'database_id', 'table_id', 'collection_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['archived'], 'boolean'],
            [['name', 'display', 'query_type', 'public_uuid'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'creator_id' => 'Creator ID',
            'database_id' => 'Database ID',
            'display' => 'Display',
            'table_id' => 'Table ID',
            'query_type' => 'Query Type',
            'dataset_query' => 'Dataset Query',
            'visualization_settings' => 'Visualization Settings',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'archived' => 'Archived',
            'result_metadata' => 'Result Metadata',
            'collection_id' => 'Collection ID',
            'public_uuid' => 'Public UUID',
        ];
    }

    public function getDashboard()
    {
        return $this->hasOne(ReportDashboard::class, ['id' => 'dashboard_id']);
    }

    public function getCreator()
    {
        return $this->hasOne(CoreUser::class, ['id' => 'creator_id']);
    }

    public function getDatabase()
    {
        return $this->hasOne(MetabaseDatabase::class, ['id' => 'database_id']);
    }

    public function getTable()
    {
        return $this->hasOne(MetabaseTable::class, ['id' => 'table_id']);
    }

    public function getCollection()
    {
        return $this->hasOne(Collection::class, ['id' => 'collection_id']);
    }
}
