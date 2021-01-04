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
            [['title', 'text', 'share'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Record::find();



        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {

            return $dataProvider;
        }


        $query->andFilterWhere([
            'id' => $this->id,
            'active' => $this->active,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'share', $this->share]);

        return $dataProvider;
    }
}
