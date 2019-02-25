<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Persons;

/**
 * PersonsSearch represents the model behind the search form of `frontend\models\Persons`.
 */
class PersonsSearch extends Persons
{
    public $full_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'midname', 'surname', 'full_name'], 'safe'],
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
        $query = Persons::find()
                ->with('personsCompanies')
                ->with('personsRegions')
                ->with('personsCities')
                ->with('personsPlaces')
                ->with('personsServices')
                ->with('contacts');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {

            return $dataProvider;
        }
        $full_name_explode = explode(' ', $this->full_name);
        foreach ($full_name_explode as $key => $item) {
            if (isset($full_name_explode[0])){
                if ($key == 0) {
                    $query->filterWhere(['or',
                        ['like','name',$item],
                        ['like','surname',$item],
                        ['like','midname',$item]]);
                }
                elseif ($key == 1) {
                    $query->andFilterWhere(['or',
                        ['like','name',$item],
                        ['like','surname',$item],
                        ['like','midname',$item]]);
                }
                elseif ($key == 2) {
                    $query->andFilterWhere(['or',
                        ['like','name',$item],
                        ['like','surname',$item],
                        ['like','midname',$item]]);
                }
            }    
            
        };
        return $dataProvider;
    }
}
