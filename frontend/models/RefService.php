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
            ['ref_company_id', 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Наименование',
            'ref_company_id' => 'Компания',
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
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyRefServices()
    {
        return $this->hasOne(RefCompany::className(), ['id' => 'ref_company_id']);
    }
    /**
     * @return array
     */
    public function serviceList($param=null)
    {
        if ($param !== null) {
            if (!empty($param['id'])) {
                return ArrayHelper::map(RefService::findAll(['id' => $param['id']]), 'id', 'name');
            }
            elseif ($param['ref_company_id'] !== null) {
                return ArrayHelper::map(RefService::findAll(['ref_company_id' => $param['ref_company_id']]), 'id', 'name');
            }
        }
        else {
            return ArrayHelper::map(RefService::find()->all(), 'id', 'name');  
        }
    }
}
