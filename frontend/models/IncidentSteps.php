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
                'super_person', 'message'], 'required',
                'message' => 'Поле обязательно к заполнению.'],
            [['incident_id', 'ref_type_steps_id', 'no_send', 'service_stop_marker'], 'integer'],
            [['res_person', 'super_person'], 'string',
                'max' => 250],
            [['message'], 'string',
                'max' => 1500],
            ['clock', 'date',
                'format' => 'php:Y-m-d H:i:s'],
            ['clock', 'compareDate'],
            ['ref_type_steps_id', 'unique', 'targetAttribute' => [
                    'ref_type_steps_id',
                    'incident_id',],
                'filter' => ['in', 'ref_type_steps_id', [1,3]]
                ],
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
            ['snapshot', 'string'],
            ];
    }
    
    public function compareDate(){
        $cur_date = $this->clock;
        $prev_inc = IncidentSteps::oldIncidentStep($this->incident_id);
        if (($this->id != $prev_inc['incident_steps_id'])&&isset($prev_inc['clock'])){
            if (strtotime($cur_date) <= strtotime($prev_inc['clock'])) {
                $this->addError('clock', 'Дата не может быть меньше '.$prev_inc['clock']);
            }
        }
        elseif ($this->id == $prev_inc['incident_steps_id']) {
            $prev_inc = IncidentSteps::oldIncidentStep($this->incident_id,1);
            if (strtotime($cur_date) <= strtotime($prev_inc['clock'])) {
                $this->addError('clock', 'Дата не может быть меньше '.$prev_inc['clock']);
            }
        }
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
            'service_stop_marker' => 'Учет длительности'
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
    protected function refServiceId(
            $incident_id,
            $ref_importance_id,
            $ref_company_id)
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
            ->join(
                    'INNER JOIN',
                    'ref_service',
                    'ref_service_id=ref_service.id'
                    )
            ->where([
                'ref_service_id' => $ref_service_id,
                'ref_importance_id'=>$ref_importance_id,
                'ref_company_id'=>$ref_company_id])
            ->orWhere([
                'ref_service_id' => 1,
                'ref_importance_id'=>$ref_importance_id,
                'ref_company_id'=>$ref_company_id])
            ->all();
        return $persons_ref_service;
    }
    /**
     * get values persons_id for service_id
     */
    protected function idPersons($incident_id,$ref_importance_id,$ref_company_id)
    {
        $persons_ref_service = IncidentSteps::refServiceId(
                $incident_id,
                $ref_importance_id,
                $ref_company_id);
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
    $ref_company_id = (new Query())
        ->select('ref_company_id')
        ->from('incident')
        ->where(['id' => $incident_id])
        ->all();
    $persons_ref_service = IncidentSteps::refServiceId(
                $incident_id,
                $ref_importance_id,
                $ref_company_id);
    $persons_ref_company = (new Query())
        ->select(['persons_id AS id_person'])
        ->from('persons_ref_company')
        ->where(['in', 'ref_company_id', $ref_company_id])
        ->andWhere(['in', 'persons_id', $persons_ref_service])
        ->all();
    $id_persons = IncidentSteps::idPersons(
            $incident_id,
            $ref_importance_id,
            $ref_company_id);
    $contacts = (new Query())
        ->select([
            'ref_contact_type.name AS type',
            'contacts.name AS contact',
            'contacts.id AS contacts_id',
            'persons.id AS persons_id',
            'CONCAT ('
            . 'persons.surname,'
            . '" ",persons.name,'
            . '" ",persons.midname) AS persons_full_name'
        ])
        ->from('persons')
        ->join(
                'INNER JOIN',
                'contacts',
                'contacts.id_person = persons.id'
        )
        ->join(
                'INNER JOIN',
                'ref_contact_type',
                'ref_contact_type.id = contacts.ref_contact_type_id'
        )
        ->where(['ref_contact_type_id' => $contact_type])
        ->andWhere(['in', 'id_person', $persons_ref_company])
        ->andWhere(['in', 'id_person', $id_persons])
        ->all();
        return $contacts;
}
public function oldIncidentStep($incident_id,$prev=null)
{
    $step = (new Query())
            ->select([
                'incident_steps.id',
                'incident_steps_id',
                'ref_importance_id',
                'incident_id',
                'ref_type_steps_id',
                'clock',
                'res_person',
                'super_person',
                'message',
                'no_send',
                'snapshot'
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
    if (isset($step)&&$prev == null){
        return $step;
    }
    elseif (isset ($step)) {
        $newstep = (new Query())
                ->select([
                'incident_steps.id',
                'incident_steps_id',
                'ref_importance_id',
                'incident_id',
                'ref_type_steps_id',
                'clock',
                'res_person',
                'super_person',
                'message',
                'no_send',
                'snapshot'
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
            ->andWhere([
                '<',
                'incident_steps.id',
                $step['id']
            ])    
            ->orderBy(['clock' => SORT_DESC])
            ->one();
        return $newstep;
    }
}
public function createText ($model){
        $clock = IncidentSteps::needlessTime($model->incident_id,1)['clock'];
        $dataTime = new \DateTime($clock);
        $clock_format = $dataTime->format('d.m.y в H:i');
        $incident = Incident::findOne($model->incident_id);
        //Инцидент на инфраструктуре
        if ($incident->ref_company_id === 2) {
            switch ($model->ref_type_steps_id) {
            //Открытие
            case 1:
                if ($model->refImportance->id === 4) {
                    $title = 'Открытие кризисного ИТ инцидента № '.$incident->inc_number;
                }
                else {
                    $title = 'Открытие инцидента № '.$incident->inc_number;
                }
                $text = $title . '. Начало: '.$model->clock
                    .'. '.$model->message
                    .'. Ответственный: '.$model->res_person.'. Контроль:'
                    .$model->super_person.' +79873242404, +74957877667 доб. 7377.';
                break;
            //Дополнение
            case 2:
                if ($model->refImportance->id === 4) {
                    $title = 'Дополнение по кризисному ИТ инциденту № '.$incident->inc_number;
                }
                else {
                    $title = 'Дополнение по ИТ инциденту № '.$incident->inc_number;
                }
                $text = $title. '. Начало: '.$clock_format
                    .'. '.$model->message.'. Ответственный: '.$model->res_person
                    .'. Контроль:'.$model->super_person.' +79873242404, +74957877667 доб. 7377.'; 
                break;
            //Закрытие
            case 3:
                if ($model->refImportance->id === 4) {
                    $title = 'Закрытие кризисного ИТ инцидента № '.$incident->inc_number;
                }
                else {
                    $title = 'Закрытие ИТ инцидента № '.$incident->inc_number;
                }
                $text = $title. '. Завершение: '.$model->clock.'. Продолжительность: '.mb_substr($incident->duration, 0, 5)
                    .'. '.$model->message.'. Ответственный: '.$model->res_person
                    .'. Контроль:'.$model->super_person.' +79873242404, +74957877667 доб. 7377.';
                break;
            }
        }    
        //Инцидент на ВОЛС ООО Единство
        elseif (($incident->ref_company_id === 1)||($incident->ref_company_id ===3)) {
            switch ($model->ref_type_steps_id) {
            //Открытие
            case 1:
                $title = 'Открытие инцидента на ВОЛС Единство № '.$incident->inc_number;
                $text = $title . '. Начало: '.$model->clock
                    .'. Приоритет: '.$model->refImportance->name. '. '.$model->message
                    .'. Ответственный: '.$model->res_person.'. Контроль:'
                    .$model->super_person.' +79873242404, +74957877667 доб. 7377.';
                break;
            //Дополнение
            case 2:
                $title = 'Дополнение по инциденту на ВОЛС Единство № '.$incident->inc_number;
                $text = $title. '. Начало: '.$clock_format
                    .'. Приоритет: ' .$model->refImportance->name.'. '.$model->message
                    .'. Ответственный: '.$model->res_person.'. Контроль:'
                    .$model->super_person.' +79873242404, +74957877667 доб. 7377.'; 
                break;
            //Закрытие
            case 3:
                $title = 'Закрытие инцидента на ВОЛС Единство № '.$incident->inc_number;
                $text = $title. '. Завершение: '.$model->clock.'. Продолжительность: '. mb_substr($incident->duration, 0, 5)
                    .'. Приоритет: ' . $model->refImportance->name . '. '.$model->message
                    .'. Ответственный: '.$model->res_person.'. Контроль:'
                    .$model->super_person.' +79873242404, +74957877667 доб. 7377.';
                break;
            }
        }
        return [
            'text' => $text, 
            'title' => $title,
                ];
    }
}
    
