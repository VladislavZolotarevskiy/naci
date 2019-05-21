<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "persons_ref_service_ref_place".
 *
 * @property int $id
 * @property int $persons_ref_service_id
 * @property int $ref_place_id
 * @property int $responsible
 *
 * @property PersonsRefService $personsRefService
 * @property RefPlace $refPlace
 */
class PersonsRefServiceRefPlace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persons_ref_service_ref_place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['persons_ref_service_id', 'ref_place_id', 'responsible'], 'integer'],
            [['persons_ref_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => PersonsRefService::className(), 'targetAttribute' => ['persons_ref_service_id' => 'id']],
            [['ref_place_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefPlace::className(), 'targetAttribute' => ['ref_place_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'persons_ref_service_id' => 'Persons Ref Service ID',
            'ref_place_id' => 'Ref Place ID',
            'responsible' => 'Responsible',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonsRefService()
    {
        return $this->hasOne(PersonsRefService::className(), ['id' => 'persons_ref_service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPlace()
    {
        return $this->hasOne(RefPlace::className(), ['id' => 'ref_place_id']);
    }
}
