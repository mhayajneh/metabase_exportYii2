<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%metabase_field}}`.
 */
class m240915_074522_create_metabase_field_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%metabase_field}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'table_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-metabase_field-table_id',
            '{{%metabase_field}}',
            'table_id',
            '{{%metabase_table}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-metabase_field-table_id', '{{%metabase_field}}');
        $this->dropTable('{{%metabase_field}}');
    }
}
