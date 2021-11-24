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
 * Class m170913_075607_create_partnership_profiles_table_partnership_profiles_types_mm
 */
class m170913_075607_create_partnership_profiles_table_partnership_profiles_types_mm extends AmosMigrationTableCreation
{
    /**
     * @inheritdoc
     */
    protected function setTableName()
    {
        $this->tableName = '{{%partnership_profiles_types_mm}}';
    }
    
    /**
     * @inheritdoc
     */
    protected function setTableFields()
    {
        $this->tableFields = [
            'id' => $this->primaryKey(),
            'partnership_profile_id' => $this->integer()->notNull()->comment('Partnership Profile ID'),
            'partnership_profiles_type_id' => $this->integer()->notNull()->comment('Partnership Profiles Type ID')
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
        $this->createIndex('partnership_profiles_types_index', $this->tableName, ['partnership_profile_id', 'partnership_profiles_type_id']);
    }
    
    /**
     * @inheritdoc
     */
    protected function addForeignKeys()
    {
        $this->addForeignKey('fk_partnership_profiles_types_partnership_profiles', $this->getRawTableName(), 'partnership_profiles_type_id', 'partnership_profiles_type', 'id');
        $this->addForeignKey('fk_partnership_profiles_partnership_profiles_types', $this->getRawTableName(), 'partnership_profile_id', 'partnership_profiles', 'id');
    }
}
