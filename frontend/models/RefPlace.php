<?php

namespace frontend\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ref_place".
 *
 * @property int $id
 * @property string $name
 *
 * @property PersonsRefPlace[] $personsRefPlaces
 */
class RefPlace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'unique',
                'message' => 'Такая площадка уже существует'],
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
    public function getPersonsRefPlaces()
    {
        return $this->hasMany(PersonsRefPlace::className(), ['ref_place_id' => 'id']);
    }
    /**
     * @return array
     */
    public function placeList()
    {
        return ArrayHelper::map(RefPlace::find()->all(), 'id', 'name'); 
    }
}
