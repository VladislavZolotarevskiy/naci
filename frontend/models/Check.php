<?php

namespace frontend\models;

class Check extends \yii\base\Model {
    public $no_send;
    public function rules()
    {
        return [
            [['no_send'], 'boolean']
        ];
    }
    public function attributeLabels()
    {
        return [
            'no_send' => 'Без рассылки',
        ];
    }
}