<?php

use yii\db\Migration;

/**
 * Class m180918_221339_create_ref_type_tt
 */
class m180918_221339_create_ref_type_tt extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /**
         * insert ref_type_tt values
         */
        $this->insert('ref_type_tt', [
            'id' => 1,
            'name'=> 'Service Now',
        ]);
        $this->insert('ref_type_tt', [
            'id' => 2,
            'name'=> 'ТТ у провайдера',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }
}
