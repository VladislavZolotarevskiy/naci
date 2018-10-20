<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "incident_steps_ref_importance".
 *
 * @property int $id
 * @property int $incident_steps_id
 * @property int $ref_importance_id
 *
 * @property IncidentSteps $incidentSteps
 * @property RefImportance $refImportance
 */
class IncidentStepsRefImportance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'incident_steps_ref_importance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['incident_steps_id', 'ref_importance_id'], 'integer'],
            [['incident_steps_id'], 'exist', 'skipOnError' => true, 'targetClass' => IncidentSteps::className(), 'targetAttribute' => ['incident_steps_id' => 'id']],
            [['ref_importance_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefImportance::className(), 'targetAttribute' => ['ref_importance_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ref_importance_id' => 'Приоритет',
        ];
    }   
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncidentSteps()
    {
        return $this->hasOne(IncidentSteps::className(), ['id' => 'incident_steps_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefImportance()
    {
        return $this->hasOne(RefImportance::className(), ['id' => 'ref_importance_id']);
    }
}
