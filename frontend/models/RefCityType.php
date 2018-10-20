<?php

namespace frontend\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ref_city_type".
 *
 * @property int $id
 * @property string $name
 *
 * @property RefCity[] $refCities
 */
class RefCityType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_city_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'unique',
                'message' => 'Такой тип населённого пункта уже существует'],
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
    public function getRefCities()
    {
        return $this->hasMany(RefCity::className(), ['ref_city_type_id' => 'id']);
    }
    /**
     * 
     * @return array
     */
    public function typesList()
    {
        return ArrayHelper::map(RefCityType::find()->all(), 'id', 'name');
    } 
}
