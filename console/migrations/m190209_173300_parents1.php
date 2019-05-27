<?php

use yii\db\Migration;

/**
 * Class m190209_173300_parents1
 */
class m190209_173300_parents1 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'ref_service',
            'ref_company_id',
            $this->bigInteger());
        $this->addColumn(
            'ref_region',
            'ref_company_id',
            $this->bigInteger());
        $this->createIndex(
                'fk_ref_service_ref_company_id', 
                'ref_service',
                'ref_company_id', 
                false
        );
        $this->createIndex(
                'fk_ref_region_ref_company_id', 
                'ref_region',
                'ref_company_id', 
                false
        );
        $this->addForeignKey(
                'fk_ref_service_ref_company_id', 
                'ref_service',
                'ref_company_id',
                'ref_company', 
                'id'
        );
        $this->addForeignKey(
                'fk_ref_region_ref_company_id', 
                'ref_region',
                'ref_company_id',
                'ref_company', 
                'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190209_173300_parents1 cannot be reverted.\n";

        return false;
    }
    */
}
