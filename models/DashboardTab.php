<?php

namespace app\models;

use yii\db\ActiveRecord;

class DashboardTab extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%dashboard_tab}}';
    }

    public function rules()
    {
        return [
            [['name', 'dashboard_id'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['dashboard_id'], 'integer'],
        ];
    }

    public function getDashboard()
    {
        return $this->hasOne(ReportDashboard::class, ['id' => 'dashboard_id']);
    }
}
