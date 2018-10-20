<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "persons_ref_city".
 *
 * @property int $id
 * @property int $persons_id
 * @property int $ref_city_id
 *
 * @property Persons $persons
 * @property RefCity $refCity
 */
class PersonsRefCity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persons_ref_city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['persons_id', 'ref_city_id'], 'integer'],
            [['ref_city_id'], 'unique',
                'targetAttribute' => [
                    'persons_id',
                    'ref_city_id'],
                'message' => 'Пользователь уже привязан к этому населённому '
                . 'пункту'],
            [['persons_id'], 'exist',
                'skipOnError' => true, 
                'targetClass' => Persons::className(), 
                'targetAttribute' => [
                    'persons_id' => 'id']],
            [['ref_city_id'], 'exist',
                'skipOnError' => true, 
                'targetClass' => RefCity::className(), 
                'targetAttribute' => [
                    'ref_city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ref_city_id' => 'Населённый пункт',
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
    public function getRefCity()
    {
        return $this->hasOne(RefCity::className(), ['id' => 'ref_city_id']);
    }
}
