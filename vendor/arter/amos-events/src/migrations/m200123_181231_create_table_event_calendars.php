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
class m200123_181231_create_table_event_calendars extends AmosMigrationTableCreation
{
    /**
     * @inheritdoc
     */
    protected function setTableName()
    {
        $this->tableName = '{{%event_calendars}}';
    }

    /**
     * @inheritdoc
     */
    protected function setTableFields()
    {
        $this->tableFields = [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->notNull()->comment('Event'),
            'title' => $this->string()->comment('Title'),
            'description' => $this->text()->comment('Description'),
            'date_start' => $this->date()->notNull()->comment('Date start'),
            'date_end' => $this->date()->defaultValue(null)->comment('Date end'),
            'hour_start' => $this->time()->defaultValue(null)->comment('Hour start'),
            'hour_end' => $this->time()->defaultValue(null)->comment('Hour end'),
            'slot_duration' => $this->integer()->comment('Slot duration'),
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
        $this->addForeignKey('fk_event_calendars_event_id1', $this->getRawTableName(), 'event_id', '{{%event}}', 'id');
    }
}
