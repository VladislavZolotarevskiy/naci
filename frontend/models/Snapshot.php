<?php
namespace frontend\models;

class Snapshot extends \yii\db\ActiveRecord
{
    public $type;
    public $contact;
    public $contacts_id;
    public $persons_id;
    public $persons_full_name;
    public $incident_steps_snapshot;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'incident_steps_snapshot'],'string'],
            [['contact', 'persons_full_name'],'string'],
            [['contact', 'persons_full_name'], 'required'],
            
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