<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ref_type_steps".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 *
 * @property IncidentSteps[] $incidentSteps
 */
class RefTypeSteps extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_type_steps';
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
    public function getIncidentSteps()
    {
        return $this->hasMany(IncidentSteps::className(), ['ref_type_steps_id' => 'id']);
    }
    public function stepList()
    {
        $steps = RefTypeSteps::find()
                ->with('incidentSteps')
                ->all();
        return ArrayHelper::map($steps, 'id', 'name');
    }        

}
