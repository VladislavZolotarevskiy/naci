<?php

namespace frontend\models;

use yii\db\Query;
use frontend\models\IncidentSteps;

/**
 * This is the model class for table "incident_steps".
 *
 * @property int $id
 * @property int $incident_id
 * @property int $ref_type_steps_id
 * @property int $clock
 * @property string $res_person
 * @property string $super_person
 * @property string $message
 * @property boolean $no_send
 *
 * @property Incident $incident
 * @property RefTypeSteps $refTypeSteps
 */
class IncidentSteps extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'incident_steps';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['incident_id', 'ref_type_steps_id', 'clock', 'res_person',
                'super_person', 'message', 'no_send'], 'required',
                'message' => 'Поле обязательно к заполнению.'],
            [['incident_id', 'ref_type_steps_id', 'no_send'], 'integer'],
            [['res_person', 'super_person'], 'string',
                'max' => 250],
            [['message'], 'string',
                'max' => 1500],
            ['clock', 'date',
                'format' => 'php:Y-m-d H:i:s'],
            [['incident_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Incident::className(),
                'targetAttribute' => ['incident_id' => 'id']],
            [['ref_type_steps_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => RefTypeSteps::className(),
                'targetAttribute' => ['ref_type_steps_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'incident_id' => 'Incident ID',
            'ref_type_steps_id' => 'Ref Type Steps ID',
            'clock' => 'Время',
            'res_person' => 'Ответственный',
            'super_person' => 'Оператор',
            'message' => 'Описание',
            'no_send' => 'Без рассылки',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncident()
    {
        return $this->hasOne(Incident::className(), ['id' => 'incident_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefTypeSteps()
    {
        return $this->hasOne(RefTypeSteps::className(), ['id' => 'ref_type_steps_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefImportance()
    {
        return $this->hasOne(
                        RefImportance::className(),
                        ['id' => 'ref_importance_id'])
                ->viaTable(
                        'incident_steps_ref_importance',
                        ['incident_steps_id' => 'id']
                        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function incidentStep($incident_steps_id)
    {
        return IncidentSteps::find()
                ->where(['id' => $incident_steps_id])
                ->with('refImportance')
                ->one();
    }
    public function needlessTime($incident_id,$ref_type_steps_id){
        $needless_time = (new Query())
                ->select('clock')
                ->from('incident_steps')
                ->where(['incident_id' => $incident_id])
                ->andWhere(['ref_type_steps_id' => $ref_type_steps_id])
                ->all();
		if (isset($needless_time[0])){
			return $needless_time[0];
		}

    }
    public function lastTime ($incident_id){
        $last_time = (new Query())
                ->select('clock')
                ->from('incident_steps')
                ->where(['incident_id' => $incident_id])
                ->orderBy(['clock' => SORT_DESC])
                ->one();
        if (isset($last_time['clock'])){
         return $last_time['clock'];
       }
    }
    /**
     * get values ref_service_id for incident_id
     * next get persons_id for ref_service_id
    */
    protected function refServiceId($incident_id,$ref_importance_id)
    {
        $ref_service_id = (new Query())
            ->select('ref_service_id')
            ->from('incident_ref_service')
            ->where(['incident_id' => $incident_id])
            ->all();
        $persons_ref_service = (new Query())
            ->select(['persons_ref_service.persons_id'])
            ->from('persons_ref_service_ref_importance')
            ->join(
                    'INNER JOIN',
                    'persons_ref_service',
                    'persons_ref_service_id=persons_ref_service.id'
                    )
            ->where(['in', 'ref_service_id', $ref_service_id])
            ->orWhere(['ref_service_id' => 1])
            ->andWhere(['ref_importance_id'=>$ref_importance_id])
            ->all();
        return $persons_ref_service;
    }
    /**
     * get values persons_id for service_id
     */
    protected function idPersons($incident_id,$ref_importance_id)
    {
        $persons_ref_service = IncidentSteps::refServiceId(
                $incident_id,
                $ref_importance_id);
        $ref_region_id = (new Query())
            ->select('ref_region_id')
            ->from('incident_ref_region')
            ->where(['incident_id' => $incident_id])
            ->all();

        $ref_city_id = (new Query())
            ->select('ref_city_id')
            ->from('incident_ref_city')
            ->where(['incident_id' => $incident_id])
            ->all();

        $ref_place_id = (new Query())
            ->select('ref_place_id')
            ->from('incident_ref_place')
            ->where(['incident_id' => $incident_id])
            ->all();

        $persons_ref_region = (new Query())
                ->select(['persons_id AS id_person'])
                ->from('persons_ref_region')
                ->where(['in','ref_region_id',$ref_region_id,])
                ->orWhere(['ref_region_id' => 1])
                ->andWhere(['in', 'persons_id', $persons_ref_service])
                ->all();

        $persons_ref_city = (new Query())
                ->select(['persons_id AS id_person'])
                ->from('persons_ref_city')
                ->where(['in', 'ref_city_id', $ref_city_id])
                ->orWhere(['ref_city_id' => 1])
                ->andWhere(['in', 'persons_id', $persons_ref_service])
                ->all();

        $persons_ref_place = (new Query())
                ->select(['persons_id AS id_person'])
                ->from('persons_ref_place')
                ->where(['in', 'ref_place_id', $ref_place_id])
                ->orWhere(['ref_place_id' => 1])
                ->andWhere(['in', 'persons_id', $persons_ref_service])
                ->all();
        $id_persons= array_unique(
            array_merge(
                    $persons_ref_region,
                    $persons_ref_place,
                    $persons_ref_city
            ), SORT_REGULAR
        );
        return $id_persons;
    }
/**
 * get contacts
 */
    public function contacts($incident_id,$ref_importance_id,$contact_type)
{
    $persons_ref_service = IncidentSteps::refServiceId(
                $incident_id,
                $ref_importance_id);
    $ref_company_id = (new Query())
        ->select('ref_company_id')
        ->from('incident')
        ->where(['id' => $incident_id])
        ->all();
    $persons_ref_company = (new Query())
        ->select(['persons_id AS id_person'])
        ->from('persons_ref_company')
        ->where(['in', 'ref_company_id', $ref_company_id])
        ->andWhere(['in', 'persons_id', $persons_ref_service])
        ->all();
    $id_persons = IncidentSteps::idPersons($incident_id,$ref_importance_id);
    $contacts = (new Query())
        ->select([
            'ref_contact_type.name AS type',
            'contacts.name AS contact',
            'CONCAT ('
            . 'persons.surname,'
            . '" ",persons.name,'
            . '" ",persons.midname) AS full_name'
        ])
        ->from('contacts')
        ->join(
                'INNER JOIN',
                'ref_contact_type',
                'contacts.ref_contact_type_id = ref_contact_type.id'
        )
        ->join(
                'INNER JOIN',
                'persons',
                'contacts.id_person = persons.id'
        )
        ->where(['ref_contact_type_id' => $contact_type])
        ->andWhere(['in', 'id_person', $persons_ref_company])
        ->andWhere(['in', 'id_person', $id_persons])
        ->all();
        return $contacts;
}
public function oldIncidentStep($incident_id)
{
    $step = (new Query())
            ->select([
                'ref_importance_id',
                'incident_id',
                'ref_type_steps_id',
                'clock',
                'res_person',
                'super_person',
                'message',
                'no_send'
            ])
            ->from('incident_steps_ref_importance')
            ->join(
                    'INNER JOIN',
                    'incident_steps',
                    'incident_steps.id = incident_steps_ref_importance.incident_steps_id'
            )
            ->where([
                'incident_id' => $incident_id
            ])
            ->orderBy(['clock' => SORT_DESC])
            ->one();
    if (isset($step)){
        return $step;
    }
}
}
