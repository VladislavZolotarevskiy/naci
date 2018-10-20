<?php

use yii\db\Migration;

/**
 * Class m180821_101922_ticket
 */
class m180821_101922_ticket extends Migration
{
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 
            'CHARACTER SET utf8 '
            . 'COLLATE utf8_unicode_ci '
            . 'ENGINE=InnoDB';
      /**
       * create table t_ticket
       */
      $this->createTable(
          '{{%t_ticket}}', [
              'id' => $this->bigPrimaryKey(20)->notNull(),
              'incident_id' => $this->bigInteger(20),
              'ref_type_tt_id' => $this->integer(11),
              't_number' => $this->string(250),
          ]
      );
      /**
       * create index for table incident_steps_ref_importance
       */
      $this->createIndex(
              'id_UNIQUE',
              't_ticket',
              'id',
              true
      );
      $this->createIndex(
              'fk_t_ticket_ref_type_tt_id',
              't_ticket',
              'ref_type_tt_id'
      );
      /**
       * create table ref_type_tt
       */
      $this->createTable(
          '{{%ref_type_tt}}', [
              'id' => $this->primaryKey(11)->notNull(),
              'name' => $this->string(250),
              'description' => $this->string(250),
          ]
      );
      /**
       * create index for table ref_type_tt
       */
      $this->createIndex(
              'id_UNIQUE',
              'ref_type_tt',
              'id',
              true
      );
      /**
       * create foreign key
       */
      $this->addForeignKey(
              'fk_t_ticket_ref_type_tt_id',
              't_ticket',
              'ref_type_tt_id',
              'ref_type_tt',
              'id'
      );
      $this->addForeignKey(
              'fk_t_ticket_incident_id',
              't_ticket',
              'incident_id',
              'incident',
              'id'
      );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      /**
       * drop foreign key
       */
      $this->dropForeignKey(
              'fk_t_ticket_ref_type_tt_id',
              't_ticket'
      );
      $this->dropForeignKey(
              'fk_t_ticket_incident_id',
              't_ticket'
      );
       /**
        * drop index
        */
       $this->dropIndex(
               'id_UNIQUE',
               'ref_type_tt'
       );
       $this->dropIndex(
               'id_UNIQUE',
               't_ticket'
       );
       $this->dropIndex(
               'fk_t_ticket_ref_type_tt_id',
               't_ticket'
       );
       /**
        * drop table
        */
       $this->dropTable('t_ticket');
       $this->dropTable('ref_type_tt');
    }
}
