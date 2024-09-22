<?php

namespace app\models;

use yii\db\ActiveRecord;

class ReportDashboard extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%report_dashboard}}';
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
            'description' => 'Description',
            'database_id' => 'Database ID',
        ];
    }

    public function getDatabase()
    {
        return $this->hasOne(MetabaseDatabase::class, ['id' => 'database_id']);
    }

    public function getCards()
    {
        return $this->hasMany(ReportCard::class, ['dashboard_id' => 'id']);
    }

    public function getTabs()
    {
        return $this->hasMany(DashboardTab::class, ['dashboard_id' => 'id']);
    }

    public function getDashboardcards()
    {
        return $this->hasMany(ReportDashboardcard::class, ['dashboard_id' => 'id']);
    }
}
