<?php

namespace frontend\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ref_region".
 *
 * @property int $id
 * @property string $name
 *
 * @property PersonsRefRegion[] $personsRefRegions
 */
class RefRegion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'unique',
                'message' => 'Такой регион уже существует'],
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
    public function getPersonsRefRegions()
    {
        return $this->hasMany(PersonsRefRegion::className(), ['ref_region_id' => 'id']);
    }
    /**
     * @return array
     */
    public function regionList()
    {
        return ArrayHelper::map(RefRegion::find()->all(), 'id', 'name'); 
    }
}
