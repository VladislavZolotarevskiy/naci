<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "persons_ref_service_ref_importance".
 *
 * @property int $id
 * @property int $persons_ref_service_id
 * @property int $ref_importance_id
 *
 * @property PersonsRefService $personsRefService
 * @property RefImportance $refImportance
 */
class PersonsRefServiceRefImportance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persons_ref_service_ref_importance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['persons_ref_service_id', 'ref_importance_id'], 'integer'],
            [['ref_importance_id'], 'unique',
                'targetAttribute' => [
                    'persons_ref_service_id',
                    'ref_importance_id'],
                'message' => 'Данный приоритет уже выбран'],
            [['persons_ref_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => PersonsRefService::className(), 'targetAttribute' => ['persons_ref_service_id' => 'id']],
            [['ref_importance_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefImportance::className(), 'targetAttribute' => ['ref_importance_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'persons_ref_service_id' => 'Сотрудник',
            'ref_importance_id' => 'Приоритет',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonsRefService()
    {
        return $this->hasOne(PersonsRefService::className(), ['id' => 'persons_ref_service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefImportance()
    {
        return $this->hasOne(RefImportance::className(), ['id' => 'ref_importance_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function importanceList($person_ref_service_id)
    {
        return $importances = PersonsRefServiceRefImportance::find()
                ->with('refImportance')
                ->where(['persons_ref_service_id' => $person_ref_service_id])
                ->all();
    }
}
