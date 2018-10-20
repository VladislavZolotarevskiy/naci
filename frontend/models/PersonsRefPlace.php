<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "persons_ref_place".
 *
 * @property int $id
 * @property int $persons_id
 * @property int $ref_place_id
 *
 * @property Persons $persons
 * @property RefPlace $refPlace
 */
class PersonsRefPlace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persons_ref_place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['persons_id', 'ref_place_id'], 'integer'],
            [['ref_place_id'], 'unique',
                'targetAttribute' => [
                    'persons_id',
                    'ref_place_id'],
                'message' => 'Пользователь уже привязан к этой площадке'],
            [['persons_id'], 'exist', 'skipOnError' => true, 'targetClass' => Persons::className(), 'targetAttribute' => ['persons_id' => 'id']],
            [['ref_place_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefPlace::className(), 'targetAttribute' => ['ref_place_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ref_place_id' => 'Площадка',
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
    public function getRefPlace()
    {
        return $this->hasOne(RefPlace::className(), ['id' => 'ref_place_id']);
    }
}
