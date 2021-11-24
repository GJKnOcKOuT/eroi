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
 * Class m170315_121500_create_table_event_type_context
 */
class m170315_121500_create_table_event_type_context extends AmosMigrationTableCreation
{
    /**
     * @inheritdoc
     */
    protected function setTableName()
    {
        $this->tableName = '{{%event_type_context}}';
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
        ];
    }

    /**
     * @inheritdoc
     */
    protected function afterTableCreation()
    {
        $this->insert($this->tableName, ['id' => 1, 'title' => 'Generic (not defined)', 'description' => '"Not defined" for events of other type (meeting, activity, deadlines, workshop, conferences, etc)']);
        $this->insert($this->tableName, ['id' => 2, 'title' => 'Project', 'description' => '"Project" for event of a project']);
        $this->insert($this->tableName, ['id' => 3, 'title' => 'Matchmaking', 'description' => '"Matchmaking" for event of matchmaking']);
    }
}
