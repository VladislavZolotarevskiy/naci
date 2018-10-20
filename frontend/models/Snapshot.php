<?php
namespace frontend\models;

class Snapshot extends \yii\db\ActiveRecord
{
    public $phone;
    public $email;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'phone'],'string']
            ];
    }
}