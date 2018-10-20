<?php

use yii\db\Migration;

/**
 * Class m180914_070831_ref_contact_type_create
 */
class m180914_070831_ref_contact_type_create extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /**
         * insert ref_importance values
         */
        $this->insert('ref_contact_type', [
            'id' => 1,
            'name'=> 'моб. телефон',
        ]);
        $this->insert('ref_contact_type', [
            'id' => 2,
            'name'=> 'e-mail',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
 
    }

}
