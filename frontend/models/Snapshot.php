<?php
namespace frontend\models;

class Snapshot extends \yii\db\ActiveRecord
{
    public $phone;
    public $email;
    public $id;
    public $contact;
    public $persons_full_name;
    public $incident_steps_snapshot;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'phone', 'persons_full_name'],'string'],
            ['persons_full_name', function ($attribute, $incident_steps_id) {
                if (in_array($attribute, IncidentSteps::find()->where(['id' => 36])->asArray()->all())){
                    $this->addError($attribute, 'Такой контакт уже существует');
                }
            
            }],
            ];
    }
    public function attributeLabels()
    {
        return [
            'persons_full_name' => 'ФИО',
            'contact' => 'Контакт',
        ];
    }
}