<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\PersonsRefCompany;

/**
 * PersonsRefCompanySearch represents the model behind the search form of `frontend\models\PersonsRefCompany`.
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

    public function search()
    {
        $query = PersonsRefService::find();

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
            'ref_company_id' => $this->ref_company_id,
        ]);

        return $dataProvider;
    }
}
