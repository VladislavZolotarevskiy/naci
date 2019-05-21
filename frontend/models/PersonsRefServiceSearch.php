<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\PersonsRefService;

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
        $query = PersonsRefService::find()
                ->with('personsRefServiceRefImportances')
                ->with('refService')
                ->with('refRegion')
                ->with('refPlace')
                ->with('refCity');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        

        return $dataProvider;
    }
}
