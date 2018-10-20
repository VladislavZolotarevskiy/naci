<?php

namespace frontend\models;


/**
 * This is the model class for table "incident_ref_region".
 *
 * @property int $id
 * @property int $incident_id
 * @property int $ref_region_id
 *
 * @property Incident $incident
 * @property RefRegion $refRegion
 */
class IncidentRefRegion extends \yii\db\ActiveRecord
{
    /**
     * @var array
     */
    public $regions;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'incident_ref_region';
    }

    /**
     * {@inheritdoc}
     **/
    public function rules()
    {
        return [
            [['incident_id', 'ref_region_id'], 'integer'],
            [['incident_id', 'ref_region_id'], 'required',
                'message' => 'Поле обязательно к заполнению.'],
            [['incident_id'], 'exist',
                'skipOnError' => true,
                'targetClass' => Incident::className(), 
                'targetAttribute' => ['incident_id' => 'id']],
            [['ref_region_id'], 'exist', 
                'skipOnError' => true, 
                'targetClass' => RefRegion::className(),
                'targetAttribute' => [
                    'ref_region_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ref_region_id' => 'Затронутые регионы',
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
    public function getRefRegion()
    {
        return $this->hasOne(RefRegion::className(), ['id' => 'ref_region_id']);
    }
}
