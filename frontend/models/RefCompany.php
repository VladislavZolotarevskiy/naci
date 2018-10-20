<?php

namespace frontend\models;

use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "ref_company".
 *
 * @property int $id
 * @property string $name
 *
 * @property PersonsRefCompany[] $personsRefCompanies
 */
class RefCompany extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'unique',
                'message' => 'Такая компания уже существует'],
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
    public function getPersonsRefCompanies()
    {
        return $this->hasMany(PersonsRefCompany::className(), ['ref_company_id' => 'id']);
    }
    /**
     * 
     * @return array
     */
    public function companyList()
    {
        return ArrayHelper::map(RefCompany::find()->all(), 'id', 'name');
    }        
}
