<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "persons_ref_service_ref_city".
 *
 * @property int $id
 * @property int $persons_ref_service_id
 * @property int $ref_city_id
 * @property int $responsible
 *
 * @property PersonsRefService $personsRefService
 * @property RefCity $refCity
 */
class PersonsRefServiceRefCity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persons_ref_service_ref_city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['persons_ref_service_id', 'ref_city_id', 'responsible'], 'integer'],
            [['persons_ref_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => PersonsRefService::className(), 'targetAttribute' => ['persons_ref_service_id' => 'id']],
            [['ref_city_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefCity::className(), 'targetAttribute' => ['ref_city_id' => 'id']],
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
            'ref_city_id' => 'Ref City ID',
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
    public function getRefCity()
    {
        return $this->hasOne(RefCity::className(), ['id' => 'ref_city_id']);
    }
}
