<?php

use yii\db\Migration;

/**
 * Class m181016_102735_duration
 */
class m181016_102735_duration extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
                'incident',
                'duration',
                $this->time()->defaultValue("00:00:00"));
        $this->addColumn(
                'incident',
                'stoppage',
                $this->time()->defaultValue("00:00:00"));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181016_102735_duration cannot be reverted.\n";

        return false;
    }
}
