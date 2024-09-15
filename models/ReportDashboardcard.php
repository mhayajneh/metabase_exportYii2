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
            [['dashboard_id', 'card_id'], 'required'],
            [['dashboard_id', 'card_id'], 'integer'],
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
