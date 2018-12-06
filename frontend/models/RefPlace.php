<?php

namespace frontend\models;

use yii\helpers\ArrayHelper;
use yii\db\Query;

/**
 * This is the model class for table "ref_place".
 *
 * @property int $id
 * @property string $name
 *
 * @property PersonsRefPlace[] $personsRefPlaces
 */
class RefPlace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'ref_city_id'], 'required'],
            ['name', 'unique',
                'message' => 'Такая площадка уже существует'],
            [['name'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Наименование',
            'ref_city_id' => 'Город',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonsRefPlaces()
    {
        return $this->hasMany(PersonsRefPlace::className(), ['ref_place_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefCity()
    {
        return $this->hasOne(RefCity::className(), ['id' => 'ref_city_id']);
    }
    /**
     * @return array
     */
    public function placeList($ref_city_id=null,$ref_region_id=null)
    {
        $ref_city_arr = [];
        $ref_region_arr = [];
        if ($ref_city_id !== null){
            foreach ($ref_city_id as $city_item){
                $ref_city_arr = $city_item;
            }
        }
        $query = new Query();
        $query->select(['id', 'ref_city_id', 'name'])->from('ref_place');
        //if $ref_city_id not empty
        if (!empty($ref_city_arr[0])) {        
            $query->where(['ref_city_id' => $ref_city_arr]);
        }      
   
        $command = $query->createCommand()->queryAll();
        return ArrayHelper::map($command, 'id', 'name');
        //return $ref_city_arr;
        
    }
}
