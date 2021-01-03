<?php

use yii\db\Migration;

class m210103_174941_create_record_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%record}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'text' => $this->string(1024),
            'share' => $this->string(255)->unique(),
            'active' => $this->boolean()->defaultValue(true),
            'user_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('fk-record-user_id',
            'record',
            'user_id',
            'user',
            'id',
            'CASCADE');

        $this->createIndex(
            'idx-record-users_id',
            '{{%record}}',
            'user_id'
        );
    }

    public function safeDown()
    {
        $this->dropIndex(
            'idx-record-users_id',
            '{{%record}}'
        );
        $this->dropForeignKey(
            'fk-record-user_id',
            '{{%record}}'
        );
        $this->dropTable('{{%record}}');
    }
}
