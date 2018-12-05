<?php

use yii\db\Migration;

/**
 * Class m181205_104937_parents
 */
class m181205_104937_parents extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'ref_city',
            'ref_region_id',
            $this->bigInteger());
        $this->addColumn(
            'ref_place',
            'ref_city_id',
            $this->bigInteger());
        $this->createIndex(
                'fk_ref_city_ref_region_id', 
                'ref_city',
                'ref_region_id', 
                false
        );
        $this->createIndex(
                'fk_ref_place_ref_city_id', 
                'ref_place',
                'ref_city_id', 
                false
        );
        $this->addForeignKey(
                'fk_ref_city_ref_region_id', 
                'ref_city',
                'ref_region_id',
                'ref_region', 
                'id'
        );
        $this->addForeignKey(
                'fk_ref_place_ref_city_id', 
                'ref_place',
                'ref_city_id',
                'ref_city', 
                'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181205_104937_parents cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181205_104937_parents cannot be reverted.\n";

        return false;
    }
    */
}
