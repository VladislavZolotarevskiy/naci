<?php

namespace frontend\models;


class FakeImportance extends \yii\db\ActiveRecord
{
    public $low;
    public $middle;
    public $high;
    public $critical;
    public function rules()
    {
        return [
            [['low', 'middle', 'high', 'critical'], 'required'],
            [['low', 'middle', 'high', 'critical'], 'boolean'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'low' => 'Низкий',
            'middle' => 'Средний',
            'high' => 'Высокий',
            'critical' => 'Критичный'
        ];
    }
}