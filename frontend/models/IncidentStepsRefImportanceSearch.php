<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\IncidentStepsRefImportance;

/**
 * IncidentStepsRefImportanceSearch represents the model behind the search form of `frontend\models\IncidentStepsRefImportance`.
 */
class IncidentStepsRefImportanceSearch extends IncidentStepsRefImportance
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'incident_steps_id', 'ref_importance_id'], 'integer'],
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
        $query = IncidentStepsRefImportance::find();

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
            'incident_steps_id' => $this->incident_steps_id,
            'ref_importance_id' => $this->ref_importance_id,
        ]);

        return $dataProvider;
    }
}
