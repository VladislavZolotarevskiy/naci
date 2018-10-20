<?php

use yii\db\Migration;

/**
 * Class m180703_091738_incident_ref_service
 */
class m180703_091738_incident_ref_service extends Migration
{
    public function safeUp()
    {
        /**
         * create table incident_ref_service
         */
        $this->createTable(
            '{{%incident_ref_service}}', [
                'id' => $this->bigPrimaryKey(20)->notNull(),
                'incident_id' => $this->bigInteger(20),
                'ref_service_id' => $this->bigInteger(20),
        ]);
        /**
         * create index for table incident_ref_service
         */
        $this->createIndex(
                'id_UNIQUE',
                'incident_ref_service',
                'id',
                true
        );
        $this->createIndex(
                'fk_incident_ref_service_incident_id', 
                'incident_ref_service',
                'incident_id'
        );
        $this->createIndex(
                'fk_incident_ref_service_ref_service_id', 
                'incident_ref_service',
                'ref_service_id'
        );
        /**
         * create foreign key
         */
        $this->addForeignKey(
                'fk_incident_ref_service_ref_service_id',
                'incident_ref_service', 
                'ref_service_id',
                'ref_service', 
                'id'
        );
        $this->addForeignKey(
                'fk_incident_ref_service_incident_id', 
                'incident_ref_service', 
                'incident_id', 
                'incident', 
                'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('incident_ref_service');
    }
    
}