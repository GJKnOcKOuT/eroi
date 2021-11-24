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
 * @package    arter\amos\admin\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationTableCreation;

/**
 * Handles the creation of table `user_contact`.
 */
class m170621_080103_create_user_contact_table extends AmosMigrationTableCreation
{

    /**
     * @inheritdoc
     */
    protected function setTableName()
    {
        $this->tableName = '{{%user_contact}}';
    }

    /**
     * @inheritdoc
     */
    protected function setTableFields()
    {
        $this->tableFields = [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('User ID'),
            'contact_id' => $this->integer()->notNull()->comment('Contact user ID'),
            'status' => $this->string(100)->notNull()->comment('Status'),
            'accepted_at' =>  $this->dateTime()->null()->defaultValue(null)->comment('Accepted at'),
            'reminders_count' => $this->smallInteger()->null()->defaultValue(0)->comment('Number of reminders'),
            'last_reminder_at' => $this->dateTime()->null()->defaultValue(null)->comment('Last reminder sent at')
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
        $this->addForeignKey('fk_user_contact_user', $this->tableName, 'user_id', 'user', 'id');
        $this->addForeignKey('fk_user_contact_contact', $this->tableName, 'contact_id', 'user', 'id');
    }
}
