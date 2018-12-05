<?php

namespace frontend\models;

use yii\db\Query;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "ref_city".
 *
 * @property int $id
 * @property string $name
 * @property int $ref_city_type_id
 *
 * @property PersonsRefCity[] $personsRefCities
 * @property RefCityType $refCityType
 */
class RefCity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ref_city_type_id','ref_region_id'], 'integer'],
            [['ref_city_type_id', 'ref_region_id', 'name'], 'required'],
            [['name'], 'unique',
                'targetAttribute' => [
                    'name',
                    'ref_city_type_id'],
                'message' => 'Такой населённый пункт уже существует'],
            [['name'], 'string', 'max' => 250],
            [['ref_city_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefCityType::className(), 'targetAttribute' => ['ref_city_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'ref_city_type_id' => 'Тип',
            'ref_region_id' => 'Регион',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonsRefCities()
    {
        return $this->hasMany(PersonsRefCity::className(), ['ref_city_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefCityType()
    {
        return $this->hasOne(RefCityType::className(), ['id' => 'ref_city_type_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefRegion()
    {
        return $this->hasOne(RefRegion::className(), ['id' => 'ref_region_id']);
    }
    /**
     * @return array
     */
    public function citiesList($id = null,$ref_region_id=null)
    {
        $query = new Query();
        if (!$id == null)
            {
                $query->select(['ref_city.id, CONCAT (ref_city_type.name,"'
                . ' ",ref_city.name) AS city'])
                      ->from('ref_city')
                      ->where(['ref_city.id' => $id])
                      ->join('INNER JOIN', 'ref_city_type',
                      'ref_city_type.id = ref_city.ref_city_type_id');
                $command = $query->createCommand()->queryAll();
                return ArrayHelper::map($command, 'id', 'city');
            }
        elseif ($ref_region_id !== null)
        {
            $query->select(['ref_city.id, CONCAT (ref_city_type.name,"'
                . ' ",ref_city.name) AS city'])
                      ->from('ref_city')
                      ->where(['ref_city.ref_region_id' => $ref_region_id])
                      ->join('INNER JOIN', 'ref_city_type',
                      'ref_city_type.id = ref_city.ref_city_type_id');
                $command = $query->createCommand()->queryAll();
                return ArrayHelper::map($command, 'id', 'city');
        }
        else 
        {
            $query->select(['ref_city.id, CONCAT (ref_city_type.name,"'
        . ' ",ref_city.name) AS city'])
               ->from('ref_city')
               //->where(['ref_city.id' => 'ALL'])
               ->join('INNER JOIN', 'ref_city_type',
                        'ref_city_type.id = ref_city.ref_city_type_id');
        $command = $query->createCommand()->queryAll();
        return ArrayHelper::map($command, 'id', 'city');        
    
        }
    }
    public function  citiesListById ($id)
    {
            $query = new Query();
            $query->select(['ref_city.id, CONCAT (ref_city_type.name,"'
            . ' ",ref_city.name) AS city'])
                ->from('ref_city')
                ->where(['ref_city.id' => $id])
                ->join('INNER JOIN', 'ref_city_type',
                        'ref_city_type.id = ref_city.ref_city_type_id');
            $command = $query->createCommand()->queryAll();
            return ArrayHelper::map($command, 'id', 'city');
    }
}    
