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
 * @package    arter\amos\invitations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationTableCreation;

/**
 * Handles the creation of table `invitation`.
 */
class m180123_140342_create_invitation_table extends AmosMigrationTableCreation
{
    /**
     * @inheritdoc
     */
    protected function setTableName()
    {
        $this->tableName = '{{%invitation}}';
    }

    /**
     * @inheritdoc
     */
    protected function setTableFields()
    {
        $this->tableFields = [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->defaultValue(null)->comment('Name'),
            'surname' => $this->string(255)->defaultValue(null)->comment('Surname'),
            'message' => $this->text()->defaultValue(null)->comment('Message'),
            'send_time' => $this->dateTime()->defaultValue(null)->comment('Time to send invitation'),
            'send' => $this->boolean()->defaultValue(null)->comment('This notification was sent?'),
            'invitation_user_id' => $this->integer(11)->notNull()->comment('Person to invitate'),
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
        $this->addForeignKey('fk_invitation_invitation_user_1', $this->getRawTableName(),'invitation_user_id', '{{%invitation_user}}', 'id');
    }

}