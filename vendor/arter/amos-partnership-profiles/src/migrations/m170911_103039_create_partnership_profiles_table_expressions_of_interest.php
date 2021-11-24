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
 * @package    arter\amos\partnershipprofiles\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationTableCreation;

/**
 * Class m170911_103039_create_partnership_profiles_table_expressions_of_interest
 */
class m170911_103039_create_partnership_profiles_table_expressions_of_interest extends AmosMigrationTableCreation
{
    /**
     * @inheritdoc
     */
    protected function setTableName()
    {
        $this->tableName = '{{%expressions_of_interest}}';
    }
    
    /**
     * @inheritdoc
     */
    protected function setTableFields()
    {
        $this->tableFields = [
            'id' => $this->primaryKey(),
            'status' => $this->string(255)->notNull()->comment('Status'),
            'partnership_offered' => $this->string(255)->notNull()->comment('Partnership offered'),
            'additional_information' => $this->string(255)->notNull()->comment('Additional information'),
            'clarifications' => $this->string(255)->notNull()->comment('Clarifications'),
            'partnership_profile_id' => $this->integer()->notNull()->comment('Partnership Profile ID')
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
        $this->createIndex('partnership_profiles_index', $this->tableName, 'partnership_profile_id');
    }
    
    /**
     * @inheritdoc
     */
    protected function addForeignKeys()
    {
        $this->addForeignKey('fk_expressions_of_interest_partnership_profiles', $this->getRawTableName(), 'partnership_profile_id', 'partnership_profiles', 'id');
    }
}
