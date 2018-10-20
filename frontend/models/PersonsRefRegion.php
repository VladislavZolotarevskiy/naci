<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "persons_ref_region".
 *
 * @property int $id
 * @property int $persons_id
 * @property int $ref_region_id
 *
 * @property Persons $persons
 * @property RefRegion $refRegion
 */
class PersonsRefRegion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persons_ref_region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['persons_id', 'ref_region_id'], 'integer'],
            [['persons_id', 'ref_region_id'], 'required'],
            [['ref_region_id'], 'unique',
                'targetAttribute' => [
                    'persons_id',
                    'ref_region_id'],
                'message' => 'Пользователь уже привязан к этому региону'],
            [['persons_id'], 'exist', 'skipOnError' => true, 'targetClass' => Persons::className(), 'targetAttribute' => ['persons_id' => 'id']],
            [['ref_region_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefRegion::className(), 'targetAttribute' => ['ref_region_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ref_region_id' => 'Регион',
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
    public function getRefRegion()
    {
        return $this->hasOne(RefRegion::className(), ['id' => 'ref_region_id']);
    }
}
