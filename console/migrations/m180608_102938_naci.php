<?php

use yii\db\Migration;
/**
 * 'bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY',
 * Class m180608_102938_naci
 */
class m180608_102938_naci extends Migration
{
    public function safeUp()
    {
        /**
         * create table contacts
         */
        $this->createTable(
            '{{%contacts}}', [
                'id' => $this->bigPrimaryKey(20),
                'id_person' => $this->bigInteger(20)->notNull(),
                'name' => $this->string(250),
                'ref_contact_type_id' => $this->integer(11),
                ]
            );
        /**
         * create index for table contacts
         */
        $this->createIndex(
                'id_UNIQUE', 
                'contacts', 
                'id', 
                true
        );	
        $this->createIndex(
                'name', 
                'contacts',
                'name'
        );
        $this->createIndex(
                'fk_contacts_id_person', 
                'contacts', 
                'id_person'
        );
        $this->createIndex(
                'fk_contacts_ref_contact_type_id', 
                'contacts',
                'ref_contact_type_id'
        );
        /**
         * create table ref_contact_type
         */
        $this->createTable(
            '{{%ref_contact_type}}',[
                'id' => $this->primaryKey(11),
                'name' => $this->string(250),
            ]
        );
        /**
         * create index for table ref_contact_type
         */
        $this->createIndex(
                'id_UNIQUE',
                'ref_contact_type',
                'id',
                true
        );
        $this->createIndex(
                'name', 
                'ref_contact_type', 
                'name'
        );
        /**
         * create foreign key
         */
        $this->addForeignKey(
                'fk_contacts_ref_contact_type_id',
                'contacts',
                'ref_contact_type_id',
                'ref_contact_type',
                'id');
        /**
         * create table persons
         */
        $this->createTable(
            '{{%persons}}', [
                'id' => $this->bigPrimaryKey(20)->notNull(),
                'name' => $this->string(200)->notNull(),
                'midname' => $this->string(200),
                'surname' => $this->string(200),
            ]
        );
        /**
         * create index for table persons
         */
        $this->createIndex(
                'id_UNIQUE', 
                'persons',
                'id',
                true
        );
        $this->createIndex(
                'name', 
                'persons', 
                'name'
        );
        $this->createIndex(
                'surname', 
                'persons', 
                'surname'
        );
        /**
         * create foreign key
         */
        $this->addForeignKey(
                'fk_contacts_id_person', 
                'contacts',
                'id_person',
                'persons', 
                'id'
        );
        /**
         * create table persons_ref_region
         */
        $this->createTable(
            '{{%persons_ref_region}}', [
                'id' => $this->bigPrimaryKey(20)->notNull(),
                'persons_id' => $this->bigInteger(20),
                'ref_region_id' => $this->bigInteger(20),
            ]
        );
        /**
         * create index for table persons_ref_region
         */
        $this->createIndex(
                'id_UNIQUE',
                'persons_ref_region',
                'id',
                true
        );
        $this->createIndex(
                'fk_persons_ref_region_persons_id', 
                'persons_ref_region',
                'persons_id'
        );
        $this->createIndex(
                'fk_persons_has_ref_region_region_id', 
                'persons_ref_region',
                'ref_region_id'
        );
        /**
         * create foreign key
         */
        $this->addForeignKey(
                'fk_persons_ref_region_persons_id', 
                'persons_ref_region',
                'persons_id',
                'persons',
                'id'
        );
        /**
         * create table ref_region
         */
        $this->createTable(
            '{{%ref_region}}', [
                'id' => $this->bigPrimaryKey(20)->notNull(),
                'name' => $this->string(250),
            ]
        );
        /**
         * create index for table ref_region
         */
        $this->createIndex(
                'id_UNIQUE', 
                'ref_region', 
                'id', 
                true
        );
        $this->createIndex(
                'name', 
                'ref_region',
                'name'
        );
        /**
         * create foreign key
         */
        $this->addForeignKey(
                'fk_persons_ref_region_ref_region_id', 
                'persons_ref_region',
                'ref_region_id', 
                'ref_region',
                'id'
        );
        /**
         * create table persons_ref_city
         */
        $this->createTable(
            '{{%persons_ref_city}}', [
                'id' => $this->bigPrimaryKey(20)->notNull(),
                'persons_id' => $this->bigInteger(20),
                'ref_city_id' => $this->bigInteger(20),
            ]
        );
        /**
         * create index for table persons_ref_city
         */
        $this->createIndex(
                'id_UNIQUE', 
                'persons_ref_city',
                'id',
                true
        );
        $this->createIndex(
                'fk_persons_ref_city_persons_id',
                'persons_ref_city',
                'persons_id'
        );
        $this->createIndex(
                'fk_persons_ref_city_ref_city_id',
                'persons_ref_city',
                'ref_city_id');
        /**
         * create table ref_city
         */
        $this->createTable(
            '{{%ref_city}}', [
                'id' => $this->bigPrimaryKey(20)->notNull(),
                'name' => $this->string(250),
                'ref_city_type_id' => $this->integer(11),
            ]
        );
        /**
         * create index for table ref_city
         */
        $this->createIndex(
                'id_UNIQUE',
                'ref_city', 
                'id',
                true
        );
        $this->createIndex(
                'name', 
                'ref_city',
                'name'
        );
        $this->createIndex(
                'fk_ref_city_ref_city_type_id', 
                'ref_city', 
                'ref_city_type_id'
        );
        /**
         * create table ref_city_type
         */
        $this->createTable(
            '{{%ref_city_type}}', [
                'id' => $this->primaryKey(11)->notNull(),
                'name' => $this->string(250),
            ]
        );
        /**
         * create index for table ref_city_type
         */
        $this->createIndex(
                'id_UNIQUE', 
                'ref_city_type',
                'id',
                true
        );
        $this->createIndex(
                'name', 
                'ref_city_type',
                'name'
        );
        /**
         * create foreign key
         */
        $this->addForeignKey(
                'fk_persons_ref_city_persons_id',
                'persons_ref_city', 
                'persons_id', 
                'persons', 
                'id'
        );
        $this->addForeignKey(
                'fk_persons_ref_city_ref_city_id', 
                'persons_ref_city',
                'ref_city_id',
                'ref_city', 
                'id'
        );
        $this->addForeignKey(
                'fk_ref_city_ref_city_type_id', 
                'ref_city',
                'ref_city_type_id', 
                'ref_city_type',
                'id'
        );
        /**
         * create table persons_ref_place
         */
        $this->createTable(
            '{{%persons_ref_place}}', [
                'id' => $this->bigPrimaryKey(20)->notNull(),
                'persons_id' => $this->bigInteger(20),
                'ref_place_id' => $this->bigInteger(20),
            ]
        );
        /**
         * create index for table persons_ref_place
         */
        $this->createIndex(
                'id_UNIQUE', 
                'persons_ref_place', 
                'id',
                true
        );
        $this->createIndex(
                'fk_persons_ref_place_persons_id',
                'persons_ref_place',
                'persons_id'
        );
        $this->createIndex(
                'fk_persons_ref_place_ref_place_id',
                'persons_ref_place',
                'ref_place_id'
        );
        /**
         * create table ref_place
         */
        $this->createTable(
            '{{%ref_place}}', [
                'id' => $this->bigPrimaryKey(20)->notNull(),
                'name' => $this->string(250),
            ]
        );
        /**
         * create index for table ref_place
         */
        $this->createIndex(
                'id_UNIQUE',
                'ref_place',
                'id',
                true
        );
        $this->createIndex(
                'name', 
                'ref_place', 
                'name'
        );
        /**
         * create foreign key
         */
        $this->addForeignKey(
                'fk_persons_ref_place_persons_id',
                'persons_ref_place', 
                'persons_id',
                'persons', 
                'id'
        );
        $this->addForeignKey(
                'fk_persons_ref_place_ref_place_id',
                'persons_ref_place',
                'ref_place_id', 
                'ref_place',
                'id'
        );
        /**
         * create table persons_ref_service
         */
        $this->createTable(
            '{{%persons_ref_service}}', [
                'id' => $this->bigPrimaryKey(20)->notNull(),
                'persons_id' => $this->bigInteger(20),
                'ref_service_id' => $this->bigInteger(20),
            ]
        );
        /**
         * create index for table persons_ref_service
         */
        $this->createIndex(
                'id_UNIQUE',
                'persons_ref_service',
                'id',
                true
            );
        $this->createIndex(
                'fk_persons_ref_service_persons_id',
                'persons_ref_service',
                'persons_id'
        );
        $this->createIndex(
                'fk_persons_ref_service_ref_service_id',
                'persons_ref_service',
                'ref_service_id'
        );
        /**
         * create table ref_service
         */
        $this->createTable(
            '{{%ref_service}}', [
                'id' => $this->bigPrimaryKey(20)->notNull(),
                'name' => $this->string(250),
            ]
        );
        /**
         * create index for table ref_service
         */
        $this->createIndex(
                'id_UNIQUE', 
                'ref_service',
                'id', 
                true
        );
        $this->createIndex(
                'name',
                'ref_service',
                'name'
        );
        /**
         * create foreign key
         */
        $this->addForeignKey(
                'fk_persons_ref_service_persons_id',
                'persons_ref_service',
                'persons_id', 
                'persons', 
                'id'
        );
        $this->addForeignKey(
                'fk_persons_ref_service_ref_service',
                'persons_ref_service', 
                'ref_service_id',
                'ref_service',
                'id'
        );
        /**
         * create table persons_ref_service_ref_importance
         */
        $this->createTable(
            '{{%persons_ref_service_ref_importance}}', [
                'id' => $this->bigPrimaryKey(20)->notNull(),
                'persons_ref_service_id' => $this->bigInteger(20),
                'ref_importance_id' => $this->integer(11),
            ]
        );
        /**
         * create index for table persons_ref_service_ref_importance
         */
        $this->createIndex(
                'id_UNIQUE', 
                'persons_ref_service_ref_importance',
                'id',
                true
        );
        $this->createIndex(
                'fk_persons_ref_service_ref_importance_persons_ref_service_id',
                'persons_ref_service_ref_importance', 
                'persons_ref_service_id'
        );
        $this->createIndex(
                'fk_persons_ref_service_ref_importance_ref_importance_id',
                'persons_ref_service_ref_importance',
                'ref_importance_id'
        );
        /**
         * create table ref_importance
         */
        $this->createTable(
            '{{%ref_importance}}', [
                'id' => $this->primaryKey(11)->notNull(),
                'name' => $this->string(250),
                'description' => $this->string(250),
            ]
        );
        /**
         * create index for table ref_importance
         */
        $this->createIndex(
                'id_UNIQUE', 
                'ref_importance',
                'id',
                true
        );
        $this->createIndex(
                'name', 
                'ref_importance', 
                'name'
        );
        /**
         * create foreign key
         */
        $this->addForeignKey(
                'fk_persons_ref_service_ref_importance_persons_ref_service_id', 
                'persons_ref_service_ref_importance', 
                'persons_ref_service_id',
                'persons_ref_service',
                'id'
        );
        $this->addForeignKey(
                'fk_persons_ref_service_ref_importance_ref_importance_id',
                'persons_ref_service_ref_importance', 
                'ref_importance_id',
                'ref_importance',
                'id'
        );
        /**
         * insert ref_importance values
         */
        $this->insert('ref_importance', [
            'id' => 1,
            'name'=> 'Низкий',
        ]);
        $this->insert('ref_importance', [
            'id' => 2,
            'name'=> 'Средний',
        ]);
        $this->insert('ref_importance', [
            'id' => 3,
            'name'=> 'Высокий',
        ]);
        $this->insert('ref_importance', [
            'id' => 4,
            'name'=> 'Критичный',
        ]);
    }
        
    public function safeDown()
    {
        $this->delete('ref_importance', [
            'id' => 4,
        ]);
        $this->delete('ref_importance', [
            'id' => 3,
        ]);
        $this->delete('ref_importance', [
            'id' => 2,
        ]);
        $this->delete('ref_importance', [
            'id' => 1,
        ]);
        $this->dropTable('contacts');
        $this->dropTable('ref_contact_type');
        $this->dropTable('persons_ref_region');
        $this->dropTable('ref_region');
        $this->dropTable('persons_ref_city');
        $this->dropTable('ref_city');
        $this->dropTable('ref_city_type');
        $this->dropTable('persons_ref_place');
        $this->dropTable('ref_place');
        $this->dropTable('persons_ref_service_ref_importance');
        $this->dropTable('ref_importance');
        $this->dropTable('persons_ref_service');
        $this->dropTable('ref_service');
        $this->dropTable('persons');
    }
    
}
