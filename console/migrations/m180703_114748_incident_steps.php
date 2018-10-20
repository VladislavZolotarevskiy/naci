<?php

use yii\db\Migration;

/**
 * Class m180703_114748_incident_steps
 */
class m180703_114748_incident_steps extends Migration
{
    public function safeUp()
    {
        /**
         * create table incident_steps
         */
        $this->createTable(
                '{{%incident_steps}}', [
                'id' => $this->bigPrimaryKey(20)->notNull(),
                'incident_id' => $this->bigInteger(20),
                'ref_type_steps_id' => $this->integer(11),
                'clock' => $this->dateTime(),
                'res_person' => $this->string(250),
                'super_person' => $this->string(250),
                'message' => $this->string(1500),
                'no_send' => $this->boolean(),    
        ]);
        /**
         * create index for table incident_steps
         */
        $this->createIndex(
                'id_UNIQUE', 
                'incident_steps',
                'id',
                true
        );
        $this->createIndex(
                'res_person', 
                'incident_steps',
                'res_person'
        );
        $this->createIndex(
                'super_person', 
                'incident_steps', 
                'super_person'
        );
        $this->createIndex(
                'fk_incident_steps_incident_id', 
                'incident_steps', 
                'incident_id'
        );
        $this->createIndex(
                'fk_incident_steps_ref_type_steps_id', 
                'incident_steps', 
                'ref_type_steps_id'
        );
        /**
         * create foreign key
         */
        $this->addForeignKey(
                'fk_incident_steps_incident_id', 
                'incident_steps', 
                'incident_id',
                'incident', 
                'id'
        );
        /**
         * create table ref_type_steps
         */
        $this->createTable(
            '{{%ref_type_steps}}', [
                'id' => $this->primaryKey(11)->notNull(),
                'name' => $this->string(250),
                'description' => $this->string(250),
            ]
        );
        /**
         * create index for table ref_type_steps
         */
        $this->createIndex(
                'id_UNIQUE',
                'ref_type_steps',
                'id',
                true
        );
        $this->createIndex(
                'name', 
                'ref_type_steps', 
                'id',
                true
        );
        /**
         * create foreign key
         */
        $this->addForeignKey(
                'fk_incident_steps_ref_type_steps_id',
                'incident_steps', 
                'ref_type_steps_id',
                'ref_type_steps', 
                'id'
        );
        /**
         * insert ref_type_steps values
         */
        $this->insert('ref_type_steps', [
            'id' => 1,
            'name'=> 'Открытие',
        ]);
        $this->insert('ref_type_steps', [
            'id' => 2,
            'name'=> 'Дополнение',
        ]);
        $this->insert('ref_type_steps', [
            'id' => 3,
            'name'=> 'Закрытие',
        ]);
    }

    public function safeDown()
    {
        $this->delete('ref_type_steps', [
            'id' => 1,
        ]);
        $this->delete('ref_type_steps', [
            'id' => 2,
        ]);
        $this->delete('ref_type_steps', [
            'id' => 3,
        ]);
        $this->dropTable('incident_steps');
        $this->dropTable('ref_type_steps');
    }
}
