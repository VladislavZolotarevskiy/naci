<?php

use yii\db\Migration;

/**
 * Class m180801_171247_incident_ref_importance
 */
class m180801_171247_incident_steps_ref_importance extends Migration
{
    public function safeUp()
    {
        /**
         * create table incident_steps_ref_importance
         */
        $this->createTable(
            '{{%incident_steps_ref_importance}}', [
                'id' => $this->bigPrimaryKey(20)->notNull(),
                'incident_steps_id' => $this->bigInteger(20),
                'ref_importance_id' => $this->integer(11),
            ]
        );
        /**
         * create index for table incident_steps_ref_importance
         */
        $this->createIndex(
                'id_UNIQUE',
                'incident_steps_ref_importance',
                'id',
                true
        );
        $this->createIndex(
                'fk_incident_steps_ref_importance_incident_steps_id',
                'incident_steps_ref_importance',
                'incident_steps_id'
        );
        $this->createIndex(
                'fk_incident_steps_ref_importance_ref_importance_id',
                'incident_steps_ref_importance',
                'ref_importance_id'
        );
        /**
         * create foreign key
         */
        $this->addForeignKey(
                'fk_incident_steps_ref_importance_ref_importance_id',
                'incident_steps_ref_importance',
                'ref_importance_id',
                'ref_importance',
                'id'
        );
        $this->addForeignKey(
                'fk_incident_steps_ref_importance_incident_steps_id',
                'incident_steps_ref_importance',
                'incident_steps_id',
                'incident_steps',
                'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('incident_steps_ref_importance');
    }
}
