<?php

namespace frontend\models;

use yii\db\Query;

/**
 * This is the model class for table "persons".
 *
 * @property int $id
 * @property string $name
 * @property string $midname
 * @property string $surname
 *
 * @property Contacts[] $contacts
 * @property PersonsRefCity[] $personsRefCities
 * @property PersonsRefPlace[] $personsRefPlaces
 * @property PersonsRefRegion[] $personsRefRegions
 * @property PersonsRefService[] $personsRefServices
 */
class Persons extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'midname', 'surname'], 'required'],
            [['surname'], 'unique', 'targetAttribute' => [
                    'midname',
                    'name',
			    'surname'],
                'message' => 'Пользователь с такими ФИО уже существует. '],
            [['name', 'midname', 'surname'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'midname' => 'Отчество',
            'surname' => 'Фамилия',
            'full_name' => 'ФИО'
        ];
    }
    /**
     * 
     * @param type $id
     * @return \frontend\models\Query
     */
    public function personFullName($id)
    {
        $query = (new Query())
                ->select(['CONCAT (surname," ",name," ",midname) AS full_name'])
                ->from('persons')
                ->where(['id'=>$id])
                ->all();
        return $query[0];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function contactsList($persons_id)
    {
        return $contacts = Contacts::find()
                ->with('person')
                ->with('refContactType')
                ->where(['id_person' => $persons_id])
                ->all();
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function regionsList($persons_id)
    {
        return $regions = PersonsRefRegion::find()
                ->with('refRegion')
                ->where(['persons_id' => $persons_id])
                ->all();
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function citiesList($id)
    {
        $query = new Query();
        $query->select(['persons_ref_city.id, CONCAT (ref_city_type.name,"'
            . ' ",ref_city.name) AS city'])
                ->where(['persons_id'=>$id])
                ->from('persons_ref_city')
                ->join('INNER JOIN', 'ref_city', 'ref_city.id = ref_city_id' )
                ->join('INNER JOIN', 'ref_city_type',
                        'ref_city_type.id = ref_city.ref_city_type_id');
        $command = $query->createCommand()->queryAll();
        return $command;
    }
    /**
     * @return yii\db\ActiveQuery
     */
    public function placesList($persons_id)
    {
        return $places = PersonsRefPlace::find()
                ->with('refPlace')
                ->where(['persons_id' => $persons_id])
                ->all();
    }
    /**
     * @return yii\db\ActiveQuery
     */
    public function serviceList($persons_id)
    {
        return $services = PersonsRefService::find()
                ->with('refService')
                ->where(['persons_id' => $persons_id])
                ->all();
    }
    /**
     * @return yii\db\ActiveQuery
     */
    public function importanceList($person_ref_service_id)
    {
        return $importances = PersonsRefServiceRefImportance::find()
                ->with('refImportance')
                ->where(['persons_ref_service_id' => $person_ref_service_id])
                ->all();
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function companiesList($persons_id)
    {
        return $regions = PersonsRefCompany::find()
                ->with('refCompany')
                ->where(['persons_id' => $persons_id])
                ->all();
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contacts::className(), ['id_person' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonsRefCities()
    {
        return $this->hasMany(PersonsRefCity::className(), ['persons_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonsRefPlaces()
    {
        return $this->hasMany(PersonsRefPlace::className(), ['persons_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonsRefRegions()
    {
        return $this->hasMany(PersonsRefRegion::className(), ['persons_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonsRefServices()
    {
        return $this->hasMany(PersonsRefService::className(), ['persons_id' => 'id']);
    }
    
    public function getPersonsCompanies()
    {
        return $this->hasMany(
                        RefCompany::className(),
                        ['id' => 'ref_company_id'])
                ->viaTable(
                        'persons_ref_company', 
                        ['persons_id' => 'id']
                        );
    }
    public function getPersonsRegions()
    {
        return $this->hasMany(
                        RefRegion::className(),
                        ['id' => 'ref_region_id'])
                ->viaTable(
                        'persons_ref_region', 
                        ['persons_id' => 'id']
                        );
    }
    public function getPersonsCities()
    {
        return $this->hasMany(
                        RefCity::className(),
                        ['id' => 'ref_city_id'])
                ->viaTable(
                        'persons_ref_city', 
                        ['persons_id' => 'id']
                        )
                ->with('refCityType');
    }
    public function getPersonsPlaces()
    {
        return $this->hasMany(
                        RefPlace::className(),
                        ['id' => 'ref_place_id'])
                ->viaTable(
                        'persons_ref_place', 
                        ['persons_id' => 'id']
                        );
    }
    public function getPersonsServices()
    {
        return $this->hasMany(
                        RefService::className(),
                        ['id' => 'ref_service_id'])
                ->viaTable(
                        'persons_ref_service', 
                        ['persons_id' => 'id']
                        );
    }
    
}
