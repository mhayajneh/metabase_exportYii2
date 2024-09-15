<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%metabase_database}}`.
 */
class m240915_074459_create_metabase_database_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%metabase_database}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%metabase_database}}');
    }
}
