<?php

use yii\db\Migration;

/**
 * Class m181018_105541_serviceStopMarker
 */
class m181018_105541_serviceStopMarker extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'incident_steps',
            'service_stop_marker',
            $this->tinyInteger() . " DEFAULT 0");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
