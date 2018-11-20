<?php

namespace frontend\models;

/**
 * This is the model class for table "t_ticket".
 *
 * @property int $id
 * @property int $incident_id
 * @property int $ref_type_tt_id
 * @property string $t_number
 *
 * @property Incident $incident
 * @property RefTypeTt $refTypeTt
 */
class TTicket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_ticket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['incident_id', 'ref_type_tt_id'], 'integer'],
            [['incident_id', 'ref_type_tt_id', 't_number'], 'required'],
            [['t_number'], 'unique',
                'targetAttribute' => [
                    'incident_id',
                    'ref_type_tt_id',
                    't_number'],
                'message' => 'Такая заявка уже существует'],
            [['t_number'], 'string', 'max' => 250],
            [['incident_id'], 'exist', 'skipOnError' => true, 'targetClass' => Incident::className(), 'targetAttribute' => ['incident_id' => 'id']],
            [['ref_type_tt_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefTypeTt::className(), 'targetAttribute' => ['ref_type_tt_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ref_type_tt_id' => 'Тип',
            't_number' => 'Номер',
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
    public function getRefTypeTt()
    {
        return $this->hasOne(RefTypeTt::className(), ['id' => 'ref_type_tt_id']);
    }
    /**
     * @param int $incident_id
     * @return array
     */
    public function ticketList($incident_id)
    {
        return $tickets = TTicket::find()
                ->with('refTypeTt')
                ->where(['incident_id' => $incident_id])
                ->all();
    }
}
