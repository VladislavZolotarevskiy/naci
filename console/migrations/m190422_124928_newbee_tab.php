<?php

use yii\db\Migration;

/**
 * Class m190422_124928_newbee_tab
 */
class m190422_124928_newbee_tab extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /**
         * create table
         */
        $this->createTable(
            '{{%persons_ref_service_ref_region}}', [
                'id' => $this->bigPrimaryKey(20)->notNull(),
                'persons_ref_service_id' => $this->bigInteger(20),
                'ref_region_id' => $this->bigInteger(20),
                'responsible' => $this->boolean()
            ]
        );
        $this->createTable(
            '{{%persons_ref_service_ref_city}}', [
                'id' => $this->bigPrimaryKey(20)->notNull(),
                'persons_ref_service_id' => $this->bigInteger(20),
                'ref_city_id' => $this->bigInteger(20),
                'responsible' => $this->boolean()
            ]
        );
        $this->createTable(
            '{{%persons_ref_service_ref_place}}', [
                'id' => $this->bigPrimaryKey(20)->notNull(),
                'persons_ref_service_id' => $this->bigInteger(20),
                'ref_place_id' => $this->bigInteger(20),
                'responsible' => $this->boolean()
            ]
        );
        /**
         * create index for persons_ref_service_ref_region
         */
        $this->createIndex(
                'id_UNIQUE',
                'persons_ref_service_ref_region',
                'id',
                true
        );
        $this->createIndex(
                'fk_persons_ref_service_ref_region_persons_id', 
                'persons_ref_service_ref_region',
                'persons_id'
        );
        $this->createIndex(
                'fk_persons_ref_service_ref_region_ref_region_id', 
                'persons_ref_service_ref_region',
                'ref_region_id'
        );
        /**
         * create index for persons_ref_service_ref_city
         */
        $this->createIndex(
                'id_UNIQUE',
                'persons_ref_service_ref_city',
                'id',
                true
        );
        $this->createIndex(
                'fk_persons_ref_service_ref_city_persons_id', 
                'persons_ref_service_ref_city',
                'persons_id'
        );
        $this->createIndex(
                'fk_persons_ref_service_ref_city_ref_city_id', 
                'persons_ref_service_ref_city',
                'ref_city_id'
        );
        /**
         * create index for persons_ref_service_ref_place
         */
        $this->createIndex(
                'id_UNIQUE',
                'persons_ref_service_ref_place',
                'id',
                true
        );
        $this->createIndex(
                'fk_persons_ref_service_ref_place_persons_id', 
                'persons_ref_service_ref_place',
                'persons_id'
        );
        $this->createIndex(
                'fk_persons_ref_service_ref_place_ref_place_id', 
                'persons_ref_service_ref_place',
                'ref_place_id'
        );
    
        /**
         * create foreign key for persons_ref_service_ref_region
         */
        $this->addForeignKey(
                'fk_persons_ref_service_ref_region_persons_id', 
                'persons_ref_service_ref_region',
                'persons_id',
                'persons',
                'id'
        );
        $this->addForeignKey(
                'fk_persons_ref_service_ref_region_ref_region_id', 
                'persons_ref_service_ref_region',
                'ref_region_id',
                'ref_region',
                'id'
        );
        /**
         * create foreign key for persons_ref_service_ref_city
         */
        $this->addForeignKey(
                'fk_persons_ref_service_ref_city_persons_id', 
                'persons_ref_service_ref_city',
                'persons_id',
                'persons',
                'id'
        );
        $this->addForeignKey(
                'fk_persons_ref_service_ref_region_ref_region_id', 
                'persons_ref_service_ref_region',
                'ref_region_id',
                'ref_region',
                'id'
        );
        /**
         * create foreign key
         */
        $this->addForeignKey(
                'fk_persons_ref_service_ref_region_persons_id', 
                'persons_ref_service_ref_region',
                'persons_id',
                'persons',
                'id'
        );
}
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190422_124928_newbee_tab cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190422_124928_newbee_tab cannot be reverted.\n";

        return false;
    }
    */
}
