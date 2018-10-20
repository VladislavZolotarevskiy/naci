<?php

use yii\db\Migration;

/**
 * Class m180630_024949_incident_ref_city
 */
class m180630_024949_incident_ref_city extends Migration
{
    /**
     * {@inheritdoc}
     */

    public function safeUp()
    {
        /**
         * create table incident_ref_city
         */
        $this->createTable(
            '{{%incident_ref_city}}', [
                'id' => $this->bigPrimaryKey(20)->notNull(),
                'incident_id' => $this->bigInteger(20),
                'ref_city_id' => $this->bigInteger(20),
        ]);
        /**
         * create index for table incident_ref_city
         */
        $this->createIndex(
                'id_UNIQUE', 
                'incident_ref_city', 
                'id',
                true
        );
        $this->createIndex(
                'fk_incident_ref_city_incident_id', 
                'incident_ref_city',
                'incident_id'
        );
        $this->createIndex(
                'fk_incident_ref_city_ref_city_id', 
                'incident_ref_city',
                'ref_city_id'
        );
        /**
         * create foreign key
         */
        $this->addForeignKey(
                'fk_incident_ref_city_ref_city_id',
                'incident_ref_city',
                'ref_city_id', 
                'ref_city', 
                'id'
        );
        $this->addForeignKey(
                'fk_incident_ref_city_incident_id', 
                'incident_ref_city',
                'incident_id',
                'incident', 
                'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('incident_ref_city');
    }

}
