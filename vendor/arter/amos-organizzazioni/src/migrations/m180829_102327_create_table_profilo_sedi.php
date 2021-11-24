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
use arter\amos\organizzazioni\models\Profilo;
use arter\amos\organizzazioni\models\ProfiloSediTypes;

/**
 * Class m180829_102327_create_table_profilo_sedi
 */
class m180829_102327_create_table_profilo_sedi extends AmosMigrationTableCreation
{
    /**
     * @inheritdoc
     */
    protected function setTableName()
    {
        $this->tableName = '{{%profilo_sedi}}';
    }

    /**
     * @inheritdoc
     */
    protected function setTableFields()
    {
        $this->tableFields = [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->comment('Name'),
            'description' => $this->text()->null()->defaultValue(null)->comment('Description'),
            'address' => $this->string(255)->null()->defaultValue(null)->comment('Address'),
            'is_main' => $this->boolean()->notNull()->defaultValue(0)->comment('Is Main'),
            'active' => $this->boolean()->notNull()->defaultValue(1)->comment('Active'),
            'website' => $this->string(255)->null()->defaultValue(null)->comment('Web Site'),
            'phone' => $this->string(50)->null()->defaultValue(null)->comment('Phone'),
            'fax' => $this->string(50)->null()->defaultValue(null)->comment('Fax'),
            'email' => $this->string(255)->null()->defaultValue(null)->comment('Email'),
            'pec' => $this->string(255)->null()->defaultValue(null)->comment('Pec'),
            'profilo_id' => $this->integer()->notNull()->comment('Profilo ID'),
            'profilo_sedi_type_id' => $this->integer()->notNull()->comment('Profilo Sedi Type ID')
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
        $this->addCommentOnTable($this->tableName, 'Profilo Sedi');
    }

    /**
     * @inheritdoc
     */
    protected function addForeignKeys()
    {
        $this->addForeignKey('fk_profilo_sedi_profilo', $this->tableName, 'profilo_id', Profilo::tableName(), 'id');
        $this->addForeignKey('fk_profilo_sedi_profilo_sedi_types', $this->tableName, 'profilo_sedi_type_id', ProfiloSediTypes::tableName(), 'id');
    }
}
