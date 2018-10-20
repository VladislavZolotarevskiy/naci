<?php

use yii\db\Migration;

/**
 * Class m180918_221709_create_ref_service_all
 */
class m180918_221709_create_ref_service_all extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /**
         * insert ref_service value
         */
        $this->insert('ref_service', [
            'id' => 1,
            'name'=> 'Все',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180918_221709_create_ref_service_all cannot be reverted.\n";

        return false;
    }
}
