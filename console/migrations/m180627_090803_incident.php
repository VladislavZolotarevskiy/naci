<?php

use yii\db\Migration;

/**
 * Class m180627_090803_incident
 */
class m180627_090803_incident extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /**
         * create table persons_ref_company
         */
        $this->createTable(
            '{{%persons_ref_company}}', [
                'id' => $this->bigPrimaryKey(20)->notNull(),
                'persons_id' => $this->bigInteger(20),
                'ref_company_id' => $this->bigInteger(20),
            ]
        );
        /**
         * create index for table persons_ref_region
         */
        $this->createIndex(
                'id_UNIQUE', 
                'persons_ref_company',
                'id', 
                true
        );
        $this->createIndex(
                'fk_persons_ref_company_persons_id', 
                'persons_ref_company',
                'persons_id'
        );
        $this->createIndex(
                'fk_persons_ref_company_ref_company_id', 
                'persons_ref_company',
                'ref_company_id'
        );
        /**
         * create foreign key
         */
        $this->addForeignKey(
                'fk_persons_ref_company_persons_id', 
                'persons_ref_company',
                'persons_id',
                'persons', 
                'id'
        );
        /**
         * create table ref_company
         */
        $this->createTable(
            '{{%ref_company}}', [
                'id' => $this->bigPrimaryKey(20)->notNull(),
                'name' => $this->string(250),
            ]
        );
        /**
         * create index for table ref_company
         */
        $this->createIndex(
                'id_UNIQUE', 
                'ref_company', 
                'id',
                true
        );
        $this->createIndex(
                'name',
                'ref_company', 
                'name'
        );
        /**
         * create foreign key
         */
        $this->addForeignKey(
                'fk_persons_ref_company_ref_company_id',
                'persons_ref_company',
                'ref_company_id',
                'ref_company',
                'id'
        );
        /**
         * create table incident_ref_region
         */
        $this->createTable(
            '{{%incident_ref_region}}', [
                'id' => $this->bigPrimaryKey(20)->notNull(),
                'incident_id' => $this->bigInteger(20),
                'ref_region_id' => $this->bigInteger(20),
            ]
        );
        /**
         * create index for table incident_ref_region
         */
        $this->createIndex(
                'id_UNIQUE', 
                'incident_ref_region', 
                'id',
                true
        );
        $this->createIndex(
                'fk_incident_ref_region_incident_id', 
                'incident_ref_region', 
                'incident_id'
        );
        $this->createIndex(
                'fk_incident_ref_region_ref_region_id', 
                'incident_ref_region', 
                'ref_region_id'
        );
        /**
         * create foreign key
         */
        $this->addForeignKey(
                'fk_incident_ref_region_ref_region_id',
                'incident_ref_region',
                'ref_region_id', 
                'ref_region',
                'id'
        );
        /**
         * create table incident
         */
        $this->createTable(
            '{{%incident}}', [
                'id' => $this->bigPrimaryKey(20)->notNull(),
                'ref_company_id' => $this->bigInteger(20),
                'inc_number' => $this->bigInteger(20),
                'period' => $this->integer(11),
            ]
        );
        /**
         * create index for table incident
         */
        $this->createIndex(
                'id_UNIQUE',
                'incident',
                'id',
                true
        );
        $this->createIndex(
                'inc_number',
                'incident',
                'inc_number'
        );
        $this->createIndex(
                'fk_incident_ref_company_id', 
                'incident',
                'ref_company_id');
        /**
         * create foreign key
         */
        $this->addForeignKey(
                'fk_incident_ref_region_incident_id', 
                'incident_ref_region',
                'incident_id',
                'incident', 
                'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('persons_ref_company');
        $this->dropTable('ref_company');
        $this->dropTable('incident_ref_region');
        $this->dropTable('incident');
    }

}
