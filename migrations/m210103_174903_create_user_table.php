<?php

use yii\db\Migration;

class m210103_174903_create_user_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'login' => $this->string()->notNull()->unique(),
            'pass' => $this->string()->notNull(),
            'role' => $this->boolean()->defaultValue(false),
            'active' => $this->boolean()->defaultValue(true)
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
