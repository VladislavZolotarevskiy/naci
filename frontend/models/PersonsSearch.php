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
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $full_name_explode = explode(' ', $this->full_name);
        $query_data = '';
        foreach ($full_name_explode as $item){
            $query_data .= '->andFilterWhere([\'like\', \'name\',\''.$item.'\'])->orFilterWhere([\'like\', \'midname\',\''.$item.'\'])->orFilterWhere([\'like\', \'surname\',\''.$item.'\'])';
        }
        $query.$query_data;
        return $dataProvider;
    }
}
