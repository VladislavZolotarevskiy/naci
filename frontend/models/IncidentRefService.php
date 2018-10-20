<?php

namespace frontend\models;

/**
 * This is the model class for table "incident_ref_service".
 *
 * @property int $id
 * @property int $incident_id
 * @property int $ref_service_id
 *
 * @property Incident $incident
 * @property RefService $refService
 */
class IncidentRefService extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'incident_ref_service';
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['incident_id', 'ref_service_id'], 'integer'],
            [['incident_id', 'ref_service_id'], 'required',
                'message' => 'Поле обязательно к заполнению.'],
            [['incident_id'], 'exist',
                'skipOnError' => true, 
                'targetClass' => Incident::className(),
                'targetAttribute' => [
                    'incident_id' => 'id']],
            [['ref_service_id'], 'exist', 
                'skipOnError' => true,
                'targetClass' => RefService::className(), 
                'targetAttribute' => [
                    'ref_service_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ref_service_id' => 'Затронутые сервисы',
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
    public function getRefService()
    {
        return $this->hasOne(RefService::className(), ['id' => 'ref_service_id']);
    }
}
