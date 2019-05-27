<?php

use yii\db\Migration;

/**
 * Class m190309_104149_userAdmin
 */
class m190309_104149_userAdmin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'user',
            'admin',
            $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190309_104149_userAdmin cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190309_104149_userAdmin cannot be reverted.\n";

        return false;
    }
    */
}
