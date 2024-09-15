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
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
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
