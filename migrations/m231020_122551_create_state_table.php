<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%state}}`.
 */
class m231020_122551_create_state_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%state}}', [
            'id'         => $this->primaryKey(),
            'country_id' => $this->integer(),
            'code'       => $this->string()->unique(),
            'name'       => $this->string()->notNull(),
            'status'     => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%state}}');
    }
}
