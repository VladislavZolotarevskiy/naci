<?php

use yii\db\Migration;

/**
 * Class m180703_095641_incident_ref_place
 */
class m180703_095641_incident_ref_place extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 
            'CHARACTER SET utf8 '
            . 'COLLATE utf8_unicode_ci '
            . 'ENGINE=InnoDB';
        /**
         * create table incident_ref_place
         */
        $this->createTable(
            '{{%incident_ref_place}}', [
                'id' => $this->bigPrimaryKey(20)->notNull(),
                'incident_id' => $this->bigInteger(20),
                'ref_place_id' => $this->bigInteger(20),
        ]);
        /**
         * create index for table incident_ref_place
         */
        $this->createIndex(
                'id_UNIQUE',
                'incident_ref_place',
                'id',
                true
        );
        $this->createIndex(
                'fk_incident_ref_place_incident_id', 
                'incident_ref_place',
                'incident_id'
        );
        $this->createIndex(
                'fk_incident_ref_place_ref_place_id', 
                'incident_ref_place',
                'ref_place_id');
        /**
         * create foreign key
         */
        $this->addForeignKey(
                'fk_incident_ref_place_ref_place_id',
                'incident_ref_place',
                'ref_place_id', 
                'ref_place',
                'id'
        );
        $this->addForeignKey(
                'fk_incident_ref_place_incident_id', 
                'incident_ref_place',
                'incident_id',
                'incident',
                'id'
        );
    }
    public function safeDown()
    {
        $this->dropTable('incident_ref_place');
    }
}
