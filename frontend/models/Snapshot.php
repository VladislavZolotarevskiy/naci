<?php
namespace frontend\models;

class Snapshot extends \yii\db\ActiveRecord
{
    public $phone;
    public $email;
    public $id;
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