<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "incident_ref_place".
 *
 * @property int $id
 * @property int $incident_id
 * @property int $ref_place_id
 *
 * @property Incident $incident
 * @property RefPlace $refPlace
 */
class IncidentRefPlace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'incident_ref_place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['incident_id', 'ref_place_id'], 'integer'],
            [['incident_id', 'ref_place_id'], 'required',
                'message' => 'Поле обязательно к заполнению.'],
            [['incident_id'], 'exist',
                'skipOnError' => true,
                'targetClass' => Incident::className(),
                'targetAttribute' => [
                    'incident_id' => 'id']],
            [['ref_place_id'], 'exist', 
                'skipOnError' => true, 
                'targetClass' => RefPlace::className(), 
                'targetAttribute' => [
                    'ref_place_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ref_place_id' => 'Затронутые площадки',
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
    public function getRefPlace()
    {
        return $this->hasOne(RefPlace::className(), ['id' => 'ref_place_id']);
    }
}
