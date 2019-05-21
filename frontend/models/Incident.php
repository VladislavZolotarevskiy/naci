<?php

namespace frontend\models;
use yii\db\Query;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "incident".
 *
 * @property int $id
 * @property int $ref_company_id
 * @property int $inc_number
 * @property int $period
 *
 * @property IncidentRefCity[] $incidentRefCities
 * @property IncidentRefPlace[] $incidentRefPlaces
 * @property IncidentRefRegion[] $incidentRefRegions
 * @property IncidentRefService[] $incidentRefServices
 */
class Incident extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'incident';
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['duration', 'stoppage'], 'string', 'max' => 10],
            [['ref_company_id', 'inc_number', 'period'], 'integer'],
            [['type','status'], 'integer']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ref_company_id' => 'Затронутая компания',
            'inc_number' => 'Порядковый № инцидента',
            'type' => 'Тип',
            'status' => 'Статус',
            'region' => 'Регион',
            'service' => 'Сервис',
            'city' => 'Нас. пункт',
            'place' => 'Площадка',
            'start_date' => 'С',
            'end_date' => 'По'
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(RefCompany::className(), [
            'id' => 'ref_company_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncidentSteps()
    {
        return $this->hasMany(IncidentSteps::className(), [
            'incident_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncidentTt()
    {
        return $this->hasMany(TTicket::className(), [
            'incident_id' => 'id'])
                ->where(['ref_type_tt_id' => 2]);
    }
    public function getIncidentSn()
    {
        return $this->hasMany(TTicket::className(), [
            'incident_id' => 'id'])
                ->where(['ref_type_tt_id' => 1]);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncidentRefCities()
    {
        return $this->hasMany(IncidentRefCity::className(), ['incident_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncidentRefPlaces()
    {
        return $this->hasMany(IncidentRefPlace::className(), ['incident_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncidentRefRegions()
    {
        return $this->hasMany(IncidentRefRegion::className(), ['incident_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncidentRefServices()
    {
        return $this->hasMany(IncidentRefService::className(), ['incident_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncidentRegions()
    {
        return $this->hasMany(
                        RefRegion::className(),
                        ['id' => 'ref_region_id'])
                ->viaTable(
                        'incident_ref_region', 
                        ['incident_id' => 'id']
                        );
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncidentCities()
    {
        return $this->hasMany(
                        RefCity::className(),
                        ['id' => 'ref_city_id'])
                ->viaTable(
                        'incident_ref_city', 
                        ['incident_id' => 'id']
                        );
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncidentServices()
    {
        return $this->hasMany(
                        RefService::className(),
                        ['id' => 'ref_service_id'])
                ->viaTable(
                        'incident_ref_service', 
                        ['incident_id' => 'id']
                        );
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncidentPlaces()
    {
        return $this->hasMany(
                        RefPlace::className(),
                        ['id' => 'ref_place_id'])
                ->viaTable(
                        'incident_ref_place', 
                        ['incident_id' => 'id']
                        );
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function cityList($incident_id)
    {
        return $cities = IncidentRefCity::find()
                ->with('refCity')
                ->where(['incident_id' => $incident_id])
                ->all();
    }
    /**
     * @param iny $incident_id
     * @return array
     */
    public function regionList($incident_id)
    {
        return $regions = IncidentRefRegion::find()
                ->with('refRegion')
                ->where(['incident_id' => $incident_id])
                ->all();
    }
    /**
     * @param int $incident_id
     * @return array
     */
    public function placeList($incident_id)
    {
        return $places = IncidentRefPlace::find()
                ->with('refPlace')
                ->where(['incident_id' => $incident_id])
                ->all();
    }
    /**
     * @param int $incident_id
     * @return array
     */
    public function serviceList($incident_id)
    {
        return $services = IncidentRefService::find()
                ->with('refService')
                ->where(['incident_id' => $incident_id])
                ->all();
    }
    /**
     * @param int $incident_id
     * @return array
     */
    public function companyList($incident_id=null)
    {
        if (!$incident_id == null){
        return $companies = IncidentRefCompany::find()
                ->with('refCompany')
                ->where(['incident_id' => $incident_id])
                ->all();
        }
        return ArrayHelper::map(RefCompany::find()->all(), 'id', 'name');
    }
    /**
     * @param int $incident_id
     * @return string
     */
    public function incidentStatus($incident_id) {
        $incident_steps = IncidentSteps::find()
            ->select('ref_type_steps_id')
            ->where(['incident_id' => $incident_id])
            ->column();
        if (in_array(3, $incident_steps)){
                $status = 'closed';
        }
        elseif ((in_array(1, $incident_steps))&&(!in_array(3, $incident_steps))){
                $status = 'opened';
        }
        else {
            $status = 'created';
        }
       return $status;
    }
    /**
     * @param int $incident_id
     * @return array
     */
    public function incidentSteps($incident_id){   
       $steps = (new Query())
               ->select([
                   'incident_steps.clock',
                   'incident_steps.id',
                   'incident_steps.message',
                   'incident_steps.no_send',
                   'incident_steps.snapshot',
                   'ref_type_steps.name AS type',
                   'ref_importance.name AS importance',
                   'ref_importance.id AS importance_id'
               ])
               ->from('incident_steps_ref_importance')
               ->join(
                       'LEFT JOIN', 'ref_importance', 
                       'incident_steps_ref_importance.ref_importance_id=
                           ref_importance.id')
               ->join(
                       'LEFT JOIN',
                       'incident_steps',
                       'incident_steps_ref_importance.incident_steps_id=incident_steps.id'
                       )        
               ->join(
                       'LEFT JOIN', 'incident',
                       'incident_steps.incident_id=
                           incident.id')
               ->join(
                       'LEFT JOIN', 'ref_type_steps', 
                       'incident_steps.ref_type_steps_id = ref_type_steps.id')
               ->where(['incident_id' => $incident_id])
               ->orderBy('clock DESC')
               ->all();
       return $steps;
    }
    public function incidentNumber($incident_id)
    {
        $number = (new Query())
                ->select([
                    'inc_number'
                ])
                ->from('incident')
                ->where([
                    'id' => $incident_id
                ])
                ->one();
        return $number;
    }
    public function printCities($array){
       $query = new Query();
       $query->select(['ref_city.id, CONCAT (ref_city_type.name,"'
       . ' ",ref_city.name) AS city'])
       ->from('ref_city')
       ->where(['in', 'ref_city.id', $array])
       ->join('INNER JOIN', 'ref_city_type',
       'ref_city_type.id = ref_city.ref_city_type_id');
       $command = $query->createCommand()->queryAll();
       return ArrayHelper::map($command, 'id', 'city');
    }
    
    public function printRegions($array){
       $query = new Query();
       $query->select(['id','name'])
       ->from('ref_region')
       ->where(['in', 'id', $array]);
       $command = $query->createCommand()->queryAll();
       return ArrayHelper::map($command, 'id', 'name');
    }
    
    public function printPlaces($array){
       $query = new Query();
       $query->select(['id','name'])
       ->from('ref_place')
       ->where(['in', 'id', $array]);
       $command = $query->createCommand()->queryAll();
       return ArrayHelper::map($command, 'id', 'name');
    }
    
    public function printServices($array){
       $query = new Query();
       $query->select(['id','name'])
       ->from('ref_service')
       ->where(['in', 'id', $array]);
       $command = $query->createCommand()->queryAll();
       return ArrayHelper::map($command, 'id', 'name');
    }
}
