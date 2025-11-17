<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tasks}}`.
 */
class m251117_084151_create_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tasks}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->null(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'user_id' => $this->integer()->notNull(),
            'assigned_to_id' => $this->integer()->notNull(),
            'validated_by_id' => $this->integer()->notNull(),
            'status' => $this->smallInteger(),
            'created_at' => $this->time(),
            'updated_at' => $this->time()
        ]);

        $this->createTable('{{%task_files}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'file_name' => $this->string(255)->notNull(),
            'file_path' => $this->string(512)->notNull(),
            'mime_type' => $this->string(100),
            'size' => $this->integer(),
            'created_at' => $this->time()
        ]);

        $this->createTable('{{%task_comments}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'reply_id' => $this->integer()->notNull(),
            'content' => $this->text()->notNull(),
            'created_at' => $this->time()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task_comments}}');
        $this->dropTable('{{%task_files}}');
        $this->dropTable('{{%tasks}}');

    }
}
