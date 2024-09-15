<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%report_dashboardcard}}`.
 */
class m240915_074551_create_report_dashboardcard_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%report_dashboardcard}}', [
            'id' => $this->primaryKey(),
            'dashboard_id' => $this->integer()->notNull(),
            'card_id' => $this->integer()->notNull(),
        ]);


        $this->addForeignKey(
            'fk-report_dashboardcard-dashboard_id',
            '{{%report_dashboardcard}}',
            'dashboard_id',
            '{{%report_dashboard}}',
            'id',
            'CASCADE'
        );


        $this->addForeignKey(
            'fk-report_dashboardcard-card_id',
            '{{%report_dashboardcard}}',
            'card_id',
            '{{%report_card}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-report_dashboardcard-dashboard_id', '{{%report_dashboardcard}}');
        $this->dropForeignKey('fk-report_dashboardcard-card_id', '{{%report_dashboardcard}}');
        $this->dropTable('{{%report_dashboardcard}}');
    }
}
