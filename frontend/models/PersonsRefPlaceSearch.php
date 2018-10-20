<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\PersonsRefPlace;

/**
 * PersonsRefPlaceSearch represents the model behind the search form of `frontend\models\PersonsRefPlace`.
 */
class PersonsRefPlaceSearch extends PersonsRefPlace
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'persons_id', 'ref_place_id'], 'integer'],
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
        $query = PersonsRefPlace::find();

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
            'ref_place_id' => $this->ref_place_id,
        ]);

        return $dataProvider;
    }
}
