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

    public function rules()
    {
        return [
            [['id', 'user_id', 'active'], 'integer'],
            [['user_id'], 'default', 'value' => function () {
                return Yii::$app->user->id;
            }],
            [['share'], 'unique'],
            [['title'], 'string', 'length' => [3, 255]],
            [['text'], 'string', 'length' => [3, 1024]],

        ];
    }

    public function fields()
    {
        return [
            'id',
            'title',
            'text',
            'share',
            'active',

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
