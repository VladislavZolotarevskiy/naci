<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\User;

/**
 * TTicketSearch represents the model behind the search form of `frontend\models\User`.
 */
class UserSearch extends User
{
//    public function rules()
//    {
//        return [
//            [['id', 'incident_id', 'ref_type_tt_id'], 'integer'],
//            [['t_number'], 'safe'],
//        ];
//    }
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'incident_id' => $this->incident_id,
//            'ref_type_tt_id' => $this->ref_type_tt_id,
//        ]);

//        $query->andFilterWhere(['like', 't_number', $this->t_number]);

        return $dataProvider;
    }
}
