<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Times;

/**
 * TimesSearch represents the model behind the search form about `backend\models\Times`.
 */
class TimesSearch extends Times
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'node_id'], 'integer'],
            [['star_time', 'end_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Times::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'node_id' => $this->node_id,
            'star_time' => $this->star_time,
            'end_time' => $this->end_time,
        ]);

        return $dataProvider;
    }
}
