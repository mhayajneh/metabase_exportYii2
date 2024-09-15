<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%dashboard_tab}}`.
 */
class m240915_074545_create_dashboard_tab_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%dashboard_tab}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'dashboard_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-dashboard_tab-dashboard_id',
            '{{%dashboard_tab}}',
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
        $this->dropForeignKey('fk-dashboard_tab-dashboard_id', '{{%dashboard_tab}}');
        $this->dropTable('{{%dashboard_tab}}');
    }
}
