<?php

namespace frontend\models;

use Yii;

class IncidentRefRegionWithoutDB extends \yii\db\ActiveRecord
{
    public $ref_region_id;

    public function rules()
    {
        return [
            [['ref_region_id'], 'integer']
        ];
    }
}