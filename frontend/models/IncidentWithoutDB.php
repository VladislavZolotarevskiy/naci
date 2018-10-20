<?php

namespace frontend\models;

use Yii;

class IncidentWithoutDB extends \yii\db\ActiveRecord
{
    public $ref_company_id;

    public function rules()
    {
        return [
            [['ref_company_id'], 'integer']
        ];
    }
}