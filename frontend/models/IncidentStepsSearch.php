<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\IncidentSteps;

/**
 * IncidentStepsSearch represents the model behind the search form of `frontend\models\IncidentSteps`.
 */
class IncidentStepsSearch extends IncidentSteps
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'incident_id', 'ref_type_steps_id'], 'integer'],
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
        $query = IncidentSteps::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'ref_type_steps_id' => $this->ref_type_steps_id,
        ]);

        return $dataProvider;
    }
}
