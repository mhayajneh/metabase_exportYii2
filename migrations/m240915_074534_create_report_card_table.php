<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%report_card}}`.
 */
class m240915_074534_create_report_card_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%report_card}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'dashboard_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-report_card-dashboard_id',
            '{{%report_card}}',
            'dashboard_id',
            '{{%report_dashboard}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-report_card-dashboard_id', '{{%report_card}}');
        $this->dropTable('{{%report_card}}');
    }
}
