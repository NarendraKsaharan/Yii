<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%city}}`.
 */
class m231020_122833_create_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%city}}', [
            'id'         => $this->primaryKey(),
            'country_id' => $this->integer(),
            'state_id'   => $this->integer(),
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
        $this->dropTable('{{%city}}');
    }
}
