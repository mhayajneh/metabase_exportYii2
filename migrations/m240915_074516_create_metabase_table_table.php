<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%metabase_table}}`.
 */
class m240915_074516_create_metabase_table_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%metabase_table}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'db' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-metabase_table-db',
            '{{%metabase_table}}',
            'db',
            '{{%metabase_database}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-metabase_table-db', '{{%metabase_table}}');
        $this->dropTable('{{%metabase_table}}');
    }
}
