<?php

namespace app\models;

use Yii;

/**
 *
 * @property int $id
 * @property int $user_id
 * @property int $record_id
 * @property string|null $comment
 *
 * @property Record $record
 * @property User $user
 */
class Comment extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%comment}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'record_id'], 'required'],
            [['user_id', 'record_id'], 'integer'],
            [['comment'], 'string', 'max' => 1024],
            [['record_id'], 'exist', 'skipOnError' => true, 'targetClass' => Record::class, 'targetAttribute' => ['record_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'record_id' => 'Record ID',
            'comment' => 'Comment',
        ];
    }

    public function getRecord()
    {
        return $this->hasOne(Record::class, ['id' => 'record_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
