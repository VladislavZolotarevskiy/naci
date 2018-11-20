<?php

namespace frontend\models;


/**
 * This is the model class for table "persons_ref_company".
 *
 * @property int $id
 * @property int $persons_id
 * @property int $ref_company_id
 *
 * @property RefCompany $refCompany
 * @property Persons $persons
 */
class PersonsRefCompany extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persons_ref_company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['persons_id', 'ref_company_id'], 'integer'], 
            [['ref_company_id'], 'unique',
                'targetAttribute' => [
                    'persons_id',
                    'ref_company_id'],
                'message' => 'Пользователь уже привязан к этой компании'],
            [['ref_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefCompany::className(), 'targetAttribute' => ['ref_company_id' => 'id']],
            [['persons_id'], 'exist', 'skipOnError' => true, 'targetClass' => Persons::className(), 'targetAttribute' => ['persons_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ref_company_id' => 'Компания',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefCompany()
    {
        return $this->hasOne(RefCompany::className(), ['id' => 'ref_company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersons()
    {
        return $this->hasOne(Persons::className(), ['id' => 'persons_id']);
    }
}
