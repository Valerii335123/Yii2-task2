<?php
namespace app\models\forms;

use yii\base\Model;

class CommentForm extends Model
{
    public $comment;

    public function rules()
    {
        return [
            [['comment'],'required'],
            [['comment'], 'string', 'min'=>3,'max' => 255],
        ];
    }
}