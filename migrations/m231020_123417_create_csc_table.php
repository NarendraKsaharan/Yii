<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%csc}}`.
 */
class m231020_123417_create_csc_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%csc}}', [
            'id'         => $this->primaryKey(),
            'country_id' => $this->integer()->notNull(),
            'state_id'   => $this->integer()->notNull(),
            'city_id'    => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%csc}}');
    }
}
