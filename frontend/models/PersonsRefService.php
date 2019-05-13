<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "persons_ref_service".
 *
 * @property int $id
 * @property int $persons_id
 * @property int $ref_service_id
 *
 * @property Persons $persons
 * @property RefService $refService
 * @property PersonsRefServiceRefImportance[] $personsRefServiceRefImportances
 */
class PersonsRefService extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persons_ref_service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['persons_id', 'ref_service_id'], 'integer'],
            [['persons_id', 'ref_service_id'], 'required'],
            [['ref_service_id'], 'unique',
                'targetAttribute' => [
                    'persons_id',
                    'ref_service_id'],
                'message' => 'Пользователь уже привязан к этому сервису'],
            [['persons_id'], 'exist', 'skipOnError' => true, 'targetClass' => Persons::className(), 'targetAttribute' => ['persons_id' => 'id']],
            [['ref_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefService::className(), 'targetAttribute' => ['ref_service_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ref_service_id' => 'Сервис',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersons()
    {
        return $this->hasOne(Persons::className(), ['id' => 'persons_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefService()
    {
        return $this->hasOne(RefService::className(), ['id' => 'ref_service_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefRegion()
    {
        return $this->hasMany(RefRegion::className(), ['id' => 'ref_region_id'])
                ->viaTable('persons_ref_service_ref_region', ['persons_ref_service_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPlace()
    {
        return $this->hasMany(RefPlace::className(), ['id' => 'ref_place_id'])
                ->viaTable('persons_ref_service_ref_place', ['persons_ref_service_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefCity()
    {
        return $this->hasMany(RefCity::className(), ['id' => 'ref_city_id'])
                ->viaTable('persons_ref_service_ref_city', ['persons_ref_service_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonsRefServiceRefImportances()
    {
        return $this->hasMany(PersonsRefServiceRefImportance::className(), ['persons_ref_service_id' => 'id']);
    }
    public function serviceList($person_ref_service_id)
    {
        $services = PersonsRefService::find()
                ->where(['id' => $person_ref_service_id])
                ->with('persons')
                ->with('refService')
                  ->all();
        return $services[0];
    }    
    public function personsId($person_ref_service_id)
    {
        $persons_id = PersonsRefService::find()
                ->where(['id' => $person_ref_service_id])
                ->limit(1)
                ->all();
        return $persons_id[0]['persons_id'];
    }        
}
