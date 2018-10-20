<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Incident;

/**
 * IncidentSearch represents the model behind the search form of `frontend\models\Incident`.
 */
class IncidentSearch extends Incident
{
    public $start;
    public $end;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ref_company_id', 'inc_number'], 'integer'],
            //[['start', 'end'], 'date'],
            [['period'], 'safe'],
            [['type', 'status'], 'integer']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
        $query = Incident::find()
                ->with('company')
                ->with('incidentRegions')
                ->with('incidentCities')
                ->with('incidentPlaces')
                ->with('incidentSteps')
                ->with('incidentTt')
                ->with('incidentSn')
                ->with('incidentServices');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->setSort([
            'attributes' => [
                'ref_company_id' => [
                    'asc' => ['ref_company.name' => SORT_ASC],
                    'desc' => ['ref_company.name' => SORT_DESC],
                ],
                'type' => [
                    'asc' => ['type' => SORT_ASC],
                    'desc' => ['type' => SORT_DESC],
                ],
                'status' => [
                    'asc' => ['status' => SORT_ASC],
                    'desc' => ['status' => SORT_DESC],  
                ],
                'inc_number' => [
                    'asc' => ['inc_number' => SORT_ASC],
                    'desc' => ['inc_number' => SORT_DESC],
                ]
            ]
        ]);
        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'inc_number' => $this->inc_number,
            'type' => $this->type,
            'status' => $this->status,
        ]);
        $query->joinWith(['company' => function ($q) {
            $q->where('ref_company.id LIKE "%' . $this->ref_company_id . '%"');
        }]);
//        $query->joinWith(['incidentSteps' => function($q) {
//            $q->where('incident_steps.clock LIKE "%' . $this->start . '%"');
//            
//        }]);
        //$query->andFilterWhere('company.name LIKE "%' . $this->company . '%"');
        
        

        return $dataProvider;
    }
}
