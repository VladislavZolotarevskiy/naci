<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\PersonsRefService;

/**
 * PersonsRefServiceSearch represents the model behind the search form of `frontend\models\PersonsRefService`.
 */
class PersonsRefServiceSearch extends PersonsRefService
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'persons_id', 'ref_service_id'], 'integer'],
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
        $query = PersonsRefService::find();

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
            'persons_id' => $this->persons_id,
            'ref_service_id' => $this->ref_service_id,
        ]);

        return $dataProvider;
    }
}
