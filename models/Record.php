<?php

namespace app\models;

use Yii;

/**
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $text
 * @property string|null $share
 * @property int|null $active
 * @property int $user_id
 *
 * @property Comment[] $comments
 * @property User $user
 */
class Record extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%record}}';
    }

    /**
     * {@inheritdoc}
     */


    public function attributeLabels()
        {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'text' => 'Text',
            'share' => 'Share',
            'active' => 'Active',
            'user_id' => 'User ID',
        ];
    }

    public function fields()
    {
        return [
            'id',
            'title',
            'text',
            'share',
            'active'

        ];
    }


    public function getComments()
    {
        return $this->hasMany(Comment::class, ['record_id' => 'id']);
    }


    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
