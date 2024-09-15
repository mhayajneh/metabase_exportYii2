<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%report_dashboard}}`.
 */
class m240915_074528_create_report_dashboard_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%report_dashboard}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%report_dashboard}}');
    }
}
