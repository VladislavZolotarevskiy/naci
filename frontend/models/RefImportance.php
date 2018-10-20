<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ref_importance".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 *
 * @property PersonsRefServiceRefImportance[] $personsRefServiceRefImportances
 */
class RefImportance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_importance';
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
     * {@inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'description' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonsRefServiceRefImportances()
    {
        return $this->hasMany(PersonsRefServiceRefImportance::className(), ['ref_importance_id' => 'id']);
    }
    public function importanceList()
    {
        return ArrayHelper::map(RefImportance::find()->all(), 'id', 'name'); 
    } 
}
