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
 * @package    arter\amos\report\migrations
 * @category   Migration
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationTableCreation;

/**
 * Handles the creation of table `report`.
 */
class m170524_123150_create_report_table extends AmosMigrationTableCreation
{
    /**
     * @inheritdoc
     */
    protected function setTableName()
    {
        $this->tableName = '{{%report}}';
    }

    /**
     * @inheritdoc
     */
    protected function setTableFields()
    {
        $this->tableFields = [
            'id' => $this->primaryKey(),
            'context_id' => $this->integer()->notNull()->comment('Report Context ID'),
            'classname' => $this->text()->notNull()->comment('Foreign class name'),
            'type' => $this->integer()->notNull()->comment('Report Type ID'),
            'content' => $this->text()->notNull()->comment('Report content'),
            'status' =>  $this->integer()->notNull()->defaultValue(0)->comment('Report Status ( 0 unread, 1 read )'),
            'creator_id' => $this->integer()->notNull()->comment('Creator User ID'),
            'read_at' => $this->dateTime()->null()->defaultValue(null)->comment('Report read at'),
            'read_by' => $this->integer()->notNull()->comment('Read User ID'),
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
}
