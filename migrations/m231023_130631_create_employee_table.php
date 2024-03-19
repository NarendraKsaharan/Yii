<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employee}}`.
 */
class m231023_130631_create_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employee}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'phone' => $this->string()->unique(),
            'gender' => $this->string(),
            'status' => $this->integer(),
            'h_date' => $this->date(),
            'dob' => $this->date(),
            'salary' => $this->decimal(10, 2),
            'address' => $this->string(),
            'city' => $this->string(),
            'pincode' => $this->integer(),
            'hobbies' => $this->string(),
            'image' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%employee}}');
    }
}
