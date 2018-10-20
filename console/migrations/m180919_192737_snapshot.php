<?php

use yii\db\Migration;
/**
 * Class m180919_192737_snapshot
 */
class m180919_192737_snapshot extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('incident_steps', 'snapshot', 'json');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        
    }
}
