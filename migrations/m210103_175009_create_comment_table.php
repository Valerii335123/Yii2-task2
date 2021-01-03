<?php

use yii\db\Migration;

class m210103_175009_create_comment_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'record_id' => $this->integer()->notNull(),
            'comment' => $this->string(1024)
        ]);
        $this->addForeignKey('fk-comment-user_id',
            'comment',
            'user_id',
            'user',
            'id',
            'CASCADE');

        $this->addForeignKey('fk-comment-record_id',
            'comment',
            'record_id',
            'record',
            'id',
            'CASCADE');


        $this->createIndex(
            'idx-comment-user_id',
            'comment',
            'user_id'
        );

        $this->createIndex(
            'idx-comment-record_id',
            'comment',
            'record_id'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-comment-user_id',
            '{{%comment}}'
        );

        $this->dropForeignKey(
            'fk-comment-record_id',
            '{{%comment}}'
        );

        $this->dropIndex(
            'idx-comment-user_id',
            '{{%comment}}'
        );

        $this->dropIndex(
            'idx-comment-record_id',
            '{{%comment}}'
        );

        $this->dropTable('{{%comment}}');
    }
}
