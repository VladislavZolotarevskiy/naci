<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "persons_ref_service_ref_region".
 *
 * @property int $id
 * @property int $persons_ref_service_id
 * @property int $ref_region_id
 * @property int $responsible
 *
 * @property PersonsRefService $personsRefService
 * @property RefRegion $refRegion
 */
class PersonsRefServiceRefRegion extends \yii\db\ActiveRecord
{
    public $count;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persons_ref_service_ref_region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['persons_ref_service_id', 'ref_region_id'], 'integer'],
            [['persons_ref_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => PersonsRefService::className(), 'targetAttribute' => ['persons_ref_service_id' => 'id']],
            [['ref_region_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefRegion::className(), 'targetAttribute' => ['ref_region_id' => 'id']],
            ['responsible', 'boolean']
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
            'ref_region_id' => 'Регион',
            'responsible' => 'Ответственный',
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
    public function getRefRegion()
    {
        return $this->hasOne(RefRegion::className(), ['id' => 'ref_region_id']);
    }
    public function RegionList($personRefServiceId) {
        return $this->findAll(['person_ref_service_id' => $personRefServiceId]);
    }
}
