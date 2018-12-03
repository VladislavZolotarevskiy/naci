<?php

namespace frontend\models;



/**
 * This is the model class for table "incident_ref_city".
 *
 * @property int $id
 * @property int $incident_id
 * @property int $ref_city_id
 *
 * @property RefCity $refCity
 * @property Incident $incident
 */
class IncidentRefCity extends \yii\db\ActiveRecord
{
    public $ref_city_id_multiply;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'incident_ref_city';
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['incident_id', 'ref_city_id'], 'integer'],
            [['incident_id', 'ref_city_id'], 'required',
                'message' => 'Поле обязательно к заполнению'],
            [['ref_city_id'], 'exist',
                'skipOnError' => true,
                'targetClass' => RefCity::className(),
                'targetAttribute' => [
                    'ref_city_id' => 'id']],
            [['incident_id'], 'exist',
                'skipOnError' => true,
                'targetClass' => Incident::className(), 
                'targetAttribute' => [
                    'incident_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ref_city_id' => 'Затронутые города',
            'ref_city_id_multiply' => 'Затронутые города',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefCity()
    {
        return $this->hasOne(RefCity::className(), ['id' => 'ref_city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncident()
    {
        return $this->hasOne(Incident::className(), ['id' => 'incident_id']);
    }
}
