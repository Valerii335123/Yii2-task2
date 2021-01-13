<?php

namespace app\models\forms;

use yii\base\Model;

class RecordForm extends Model
{
    public $id;
    public $title;
    public $text;
    public $active;
    public $share;
    public $user_id;

    public function rules()
    {
        return [
            [['title', 'text', 'active', 'id', 'share'], 'required'],
            [['title'], 'string', 'min' => 3, 'max' => 255],
            [['text'], 'string', 'min' => 3, 'max' => 1024],
            [['active'], 'boolean'],

        ];
    }
}