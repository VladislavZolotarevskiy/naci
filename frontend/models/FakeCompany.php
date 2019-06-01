<?php

namespace frontend\models;
use \yii\base\Model;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "ref_company".
 *
 * @property int $id
 * @property string $name
 *
 * @property PersonsRefCompany[] $personsRefCompanies
 */
class FakeCompany extends Model
{
    public $fake_company_id = null;
    public function rules()
    {
        return [
            ['fake_company_id', 'required'],
            ['fake_company_id', 'integer'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'fake_company_id' => 'Компания',
        ];
    }
    
    public function fakeCompanyList($person_id) {
        return array_unique (ArrayHelper::map(
                PersonsRefCompany::find(['person_id' => $person_id])->with('refCompany')->all(),
                'refCompany.id',
                'refCompany.name'));
    }
}