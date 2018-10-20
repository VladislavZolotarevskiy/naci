<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ref_type_tt".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 *
 * @property TTicket[] $tTickets
 */
class RefTypeTt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_type_tt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTTickets()
    {
        return $this->hasMany(TTicket::className(), ['ref_type_tt_id' => 'id']);
    }
    public function typeList()
    {
        return ArrayHelper::map(RefTypeTt::find()->all(), 'id', 'name'); 
    } 
}
