<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\events\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationTableCreation;

/**
 * Class m170315_121506_create_table_event_type
 */
class m200123_181331_create_table_event_calendars_slots extends AmosMigrationTableCreation
{
    /**
     * @inheritdoc
     */
    protected function setTableName()
    {
        $this->tableName = '{{%event_calendars_slots}}';
    }

    /**
     * @inheritdoc
     */
    protected function setTableFields()
    {
        $this->tableFields = [
            'id' => $this->primaryKey(),
            'event_calendars_id' => $this->integer()->notNull()->comment('Event'),
            'date' => $this->date()->notNull()->comment('Date'),
            'hour_start' => $this->time()->notNull()->comment('Time start'),
            'hour_end' => $this->time()->defaultValue(null)->comment('Time end'),
            'user_id' => $this->integer()->defaultValue(null)->comment('User'),
            'booked_at' => $this->date()->null()->comment('Booked at'),
        ];
    }

    /**
     * @inheritdoc
     */
    protected function beforeTableCreation()
    {
        parent::beforeTableCreation();
        $this->setAddCreatedUpdatedFields(true);
    }

    /**
     * @inheritdoc
     */
    protected function addForeignKeys()
    {
        $this->addForeignKey('fk_event_calendars_slots_user_id1', $this->getRawTableName(), 'user_id', '{{%user}}', 'id');
        $this->addForeignKey('fk_event_calendars_slots_event_calendars_id1', $this->getRawTableName(), 'event_calendars_id', '{{%event_calendars}}', 'id');
    }
}
