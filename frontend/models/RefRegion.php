<?php

namespace frontend\models;

use yii\helpers\ArrayHelper;
use yii\db\Query;

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
            ['ref_company_id', 'integer']
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
    public function getPersonsRefRegions()
    {
        return $this->hasMany(PersonsRefRegion::className(), ['ref_region_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompanyRefRegions()
    {
        return $this->hasOne(RefCompany::className(), ['id' => 'ref_company_id']);
    }
    /**
     * @return array
     */
    public function regionList($param=null)
    {
        if ($param !== null) {
            if (!empty($param['id'])) {
                return ArrayHelper::map(RefRegion::findAll(['id' => $param['id']]), 'id', 'name');
            }
            elseif ($param['ref_company_id'] !== null) {
                return ArrayHelper::map(RefRegion::findAll(['ref_company_id' => $param['ref_company_id']]), 'id', 'name');
            }
        }
        else {
            return ArrayHelper::map(RefRegion::find()->all(), 'id', 'name');
        }
//        if ($id !== null) {
//            return $id;
//            //return ArrayHelper::map(RefRegion::findAll(['id' => $id]), 'id', 'name');
//        }
//        elseif ($ref_company_id !== null) {
            //$ref_company_arr = [];
//            foreach ($ref_company_id as $company_item){
//                $ref_company_arr = $company_item;
//            }
//        $query = new Query();
//        $query->select(['id', 'name', 'ref_company_id'])->from('ref_region');
//        $query->where(['ref_company_id' => $ref_company_id]);
//                  
//        $command = $query->createCommand()->queryAll();
        
                //->where(['ref_company_id' => $ref_company_id])
//                
//        //return ArrayHelper::map($regions, 'id', 'name');
//        $regions = RefRegion::find()
//                ->where(['ref_company_id' => $ref_company_id])
//                ->all();
//        return ArrayHelper::map($regions, 'id', 'name');
        //return $ref_company_id;
//          }
    }
}
