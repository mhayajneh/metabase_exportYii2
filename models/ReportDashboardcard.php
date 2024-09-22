<?php

namespace app\models;

use yii\db\ActiveRecord;

class ReportDashboardcard extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%report_dashboardcard}}';
    }

    public function rules()
    {
        return [
            [['dashboard_id', 'name'], 'required'],
            [['dashboard_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dashboard_id' => 'Dashboard ID',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    public function getDashboard()
    {
        return $this->hasOne(ReportDashboard::class, ['id' => 'dashboard_id']);
    }

    public function getCard()
    {
        return $this->hasOne(ReportCard::class, ['id' => 'card_id']);
    }
}
