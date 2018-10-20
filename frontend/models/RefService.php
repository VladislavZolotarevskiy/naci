<?php

namespace frontend\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ref_service".
 *
 * @property int $id
 * @property string $name
 *
 * @property PersonsRefService[] $personsRefServices
 */
class RefService extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'unique',
                'message' => 'Такой сервис уже существует'],
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
    public function getPersonsRefServices()
    {
        return $this->hasMany(PersonsRefService::className(), ['ref_service_id' => 'id']);
    }
    /**
     * @return array
     */
    public function serviceList()
    {
        return ArrayHelper::map(RefService::find()->all(), 'id', 'name'); 
    }
}
