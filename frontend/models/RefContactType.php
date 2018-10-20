<?php

namespace frontend\models;

use \yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ref_contact_type".
 *
 * @property int $id
 * @property string $name
 *
 * @property Contacts[] $contacts
 */
class RefContactType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_contact_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'unique',
                'message' => 'Такой тип контактов уже существует'],
            [['name'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Наименование',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contacts::className(), ['ref_contact_type_id' => 'id']);
    }
    /**
     * 
     */
    public function contactTypesList()
    {
        return ArrayHelper::map(RefContactType::find()->all(), 'id', 'name'); 
    }        
    
}
