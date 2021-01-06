<?php

namespace app\models\searchModel;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Record;

class RecordSearch extends Record
{

    public function rules()
    {
        return [
            [['id', 'active', 'user_id'], 'integer'],
            [['title', 'text'], 'string'],

        ];
    }


    public function search($params)
    {
        $query = Record::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 3,
            ],

        ]);

        $this->load($params);

        if (!$this->validate()) {

            return $dataProvider;
        }


        $query->andFilterWhere([
            'id' => $this->id,
            'active' => $this->active,
            'user_id' => \Yii::$app->user->id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'share', $this->share]);

        return $dataProvider;
    }
}
