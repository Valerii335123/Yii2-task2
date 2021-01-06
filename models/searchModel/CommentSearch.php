<?php

namespace app\models\searchModel;


use app\models\Comment;
use app\models\Record;
use yii\data\ActiveDataProvider;

class CommentSearch extends Comment
{
    public function rules()
    {
        return [
            [['id', 'record_id', 'user_id'], 'integer'],
            [['comment'], 'string'],
            [['created'], 'datetime'],
        ];
    }

    public function search($params, $share)
    {
        $record = Record::findOne(['share' => $share]);
        $comments = Comment::find();
        $comments->where(['record_id' => $record->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $comments,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created' => SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {

            return $dataProvider;
        }

        return $dataProvider;
    }
}