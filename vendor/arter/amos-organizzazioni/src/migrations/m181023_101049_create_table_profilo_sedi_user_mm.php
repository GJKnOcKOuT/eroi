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
 * @package    arter\amos\organizzazioni\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationTableCreation;

/**
 * Class m181023_101049_create_table_profilo_sedi_user_mm
 */
class m181023_101049_create_table_profilo_sedi_user_mm extends AmosMigrationTableCreation
{
    /**
     * @inheritdoc
     */
    protected function setTableName()
    {
        $this->tableName = '{{%profilo_sedi_user_mm}}';
    }

    /**
     * @inheritdoc
     */
    protected function setTableFields()
    {
        $this->tableFields = [
            'id' => $this->primaryKey(),
            'profilo_sedi_id' => $this->integer()->notNull()->comment('Profilo Sedi Id'),
            'user_id' => $this->integer()->notNull()->comment('User Id'),
            'status' => $this->string(255)->null()->defaultValue(null)->comment('Stato'),
            'role' => $this->string(255)->null()->defaultValue(null)->comment('Ruolo')
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
    protected function afterTableCreation()
    {
        $this->addCommentOnTable($this->tableName, 'Profilo Sedi User Mm');
        $this->createIndex('profilo_sedi_user_mm_index', $this->tableName, ['profilo_sedi_id', 'user_id']);
    }

    /**
     * @inheritdoc
     */
    protected function addForeignKeys()
    {
        $this->addForeignKey('fk_profilo_sedi_user', $this->getRawTableName(), 'profilo_sedi_id', '{{%profilo_sedi}}', 'id');
        $this->addForeignKey('fk_user_profilo_sedi', $this->getRawTableName(), 'user_id', '{{%user}}', 'id');
    }
}
