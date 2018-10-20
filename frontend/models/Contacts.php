<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "contacts".
 *
 * @property int $id
 * @property int $id_person
 * @property string $name
 * @property int $ref_contact_type_id
 *
 * @property Persons $person
 * @property RefContactType $refContactType
 */
class Contacts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_person', 'ref_contact_type_id', 'name'], 'required'],
            [['id_person', 'ref_contact_type_id'], 'integer'],
            ['name', 'string', 'max' => 250],
            ['name', 'unique',
                'message' => 'Контакт уже существует'],
            [['id_person'], 'exist',
                'skipOnError' => true, 
                'targetClass' => Persons::className(),
                'targetAttribute' => [
                    'id_person' => 'id']],
            [['ref_contact_type_id'], 
                'exist',
                'skipOnError' => true,
                'targetClass' => RefContactType::className(), 
                'targetAttribute' => ['ref_contact_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_person' => 'Id Person',
            'name' => 'Содержимое',
            'ref_contact_type_id' => 'Тип контакта',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Persons::className(), ['id' => 'id_person']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefContactType()
    {
        return $this->hasOne(RefContactType::className(), ['id' => 'ref_contact_type_id']);
    }
}
