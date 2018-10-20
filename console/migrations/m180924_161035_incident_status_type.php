<?php

use yii\db\Migration;

/**
 * Class m180924_161035_incident_status_type
 */
class m180924_161035_incident_status_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
                'incident',
                'type',
                $this->tinyInteger() . " DEFAULT 1");
        $this->addColumn('incident', 
                'status',
                $this->tinyInteger() . " DEFAULT 1");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180924_161035_incident_status_type cannot be reverted.\n";

        return false;
    }
    */
}
