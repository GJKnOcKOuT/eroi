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
class m170315_121506_create_table_event_type extends AmosMigrationTableCreation
{
    /**
     * @inheritdoc
     */
    protected function setTableName()
    {
        $this->tableName = '{{%event_type}}';
    }

    /**
     * @inheritdoc
     */
    protected function setTableFields()
    {
        $this->tableFields = [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull()->comment('Title'),
            'description' => $this->text()->notNull()->comment('Description'),
            'color' => $this->string(255)->notNull()->comment('Color'),
            'locationRequested' => $this->boolean()->notNull()->defaultValue(0)->comment('Location Requested'),
            'durationRequested' => $this->boolean()->notNull()->defaultValue(0)->comment('Duration Requested'),
            'logoRequested' => $this->boolean()->notNull()->defaultValue(0)->comment('Logo Requested'),
            'event_context_id' => $this->integer()->notNull()->comment('Event Context ID')
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
        $this->addForeignKey('fk_event_type_event_type_context', $this->getRawTableName(), 'event_context_id', '{{%event_type_context}}', 'id');
    }
}
