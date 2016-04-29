<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CamSet;

/**
 * CamSetSearch represents the model behind the search form about `backend\models\CamSet`.
 */
class CamSetSearch extends CamSet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cam_id'], 'integer'],
            [['ip', 'pixels', 'code_rate', 'frame_rate'], 'safe'],
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
        $query = CamSet::find();

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
            'cam_id' => $this->cam_id,
        ]);

        $query->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'pixels', $this->pixels])
            ->andFilterWhere(['like', 'code_rate', $this->code_rate])
            ->andFilterWhere(['like', 'frame_rate', $this->frame_rate]);

        return $dataProvider;
    }
}
