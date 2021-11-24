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
 * Class m170913_083045_create_partnership_profiles_table_partnership_profiles_countries_mm
 */
class m170913_083045_create_partnership_profiles_table_partnership_profiles_countries_mm extends AmosMigrationTableCreation
{
    /**
     * @inheritdoc
     */
    protected function setTableName()
    {
        $this->tableName = '{{%partnership_profiles_countries_mm}}';
    }
    
    /**
     * @inheritdoc
     */
    protected function setTableFields()
    {
        $this->tableFields = [
            'id' => $this->primaryKey(),
            'partnership_profile_id' => $this->integer()->notNull()->comment('Partnership Profiles ID'),
            'country_id' => $this->integer()->notNull()->comment('Country ID')
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
        $this->createIndex('countries_index', $this->tableName, ['partnership_profile_id', 'country_id']);
    }
    
    /**
     * @inheritdoc
     */
    protected function addForeignKeys()
    {
        $this->addForeignKey('fk_countries_partnership_profiles', $this->getRawTableName(), 'country_id', 'istat_nazioni', 'id');
        $this->addForeignKey('fk_partnership_profiles_countries', $this->getRawTableName(), 'partnership_profile_id', 'partnership_profiles', 'id');
    }
}
