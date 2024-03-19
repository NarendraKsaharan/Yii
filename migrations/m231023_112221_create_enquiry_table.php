<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%enquiry}}`.
 */
class m231023_112221_create_enquiry_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%enquiry}}', [
            'id'       => $this->primaryKey(),
            'name'     => $this->string()->notNull(),
            'email'    => $this->string()->notNull(),
            'phone'    => $this->string()->notNull(),
            'message'  => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%enquiry}}');
    }
}
