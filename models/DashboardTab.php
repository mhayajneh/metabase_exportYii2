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
            [['dashboard_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'dashboard_id' => 'Dashboard ID',
        ];
    }


    public function getDashboard()
    {
        return $this->hasOne(ReportDashboard::class, ['id' => 'dashboard_id']);
    }
}
