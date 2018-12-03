<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TTicket;

/**
 * TTicketSearch represents the model behind the search form of `frontend\models\TTicket`.
 */
class TTicketSearch extends TTicket
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'incident_id', 'ref_type_tt_id'], 'integer'],
            [['t_number'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = TTicket::find()->with('incident');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' =>false
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'incident_id' => $this->incident_id,
            'ref_type_tt_id' => $this->ref_type_tt_id,
        ]);

        $query->andFilterWhere(['like', 't_number', $this->t_number]);

        return $dataProvider;
    }
}
