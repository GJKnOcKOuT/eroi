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
 * @package    arter\amos\best\practice\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationTableCreation;

/**
 * Class m181220_140440_create_table_best_practice
 */
class m181220_140440_create_table_best_practice extends AmosMigrationTableCreation
{
    /**
     * @inheritdoc
     */
    protected function setTableName()
    {
        $this->tableName = '{{%best_practice}}';
    }

    /**
     * @inheritdoc
     */
    protected function setTableFields()
    {
        $this->tableFields = [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull()->comment('Title'),
            'synthesis' => $this->text()->notNull()->comment('Synthesis'),
            'facilitator_text' => $this->string(255)->null()->defaultValue(null)->comment('Facilitator Text'),
            'facilitator_organization_text' => $this->string(255)->null()->defaultValue(null)->comment('Facilitator Organization Text'),
            'users_text' => $this->text()->null()->defaultValue(null)->comment('Users Text'),
            'tr_doc_link' => $this->text()->null()->defaultValue(null)->comment('Tr Doc Link'),
            'status' => $this->text()->null()->defaultValue(null)->comment('Status'),
            'validated_at_least_once' => $this->boolean()->null()->defaultValue(null)->comment('Validated At Least Once'),
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
