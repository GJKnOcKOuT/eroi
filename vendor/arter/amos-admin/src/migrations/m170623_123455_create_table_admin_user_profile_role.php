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
 * Class m170623_123455_create_table_admin_user_profile_role
 */
class m170623_123455_create_table_admin_user_profile_role extends AmosMigrationTableCreation
{
    /**
     * @inheritdoc
     */
    protected function setTableName()
    {
        $this->tableName = '{{%user_profile_role}}';
    }
    
    /**
     * @inheritdoc
     */
    protected function setTableFields()
    {
        $this->tableFields = [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->comment('Name'),
            'enabled' => $this->boolean()->notNull()->comment('Enabled'),
            'order' => $this->smallInteger()->notNull()->comment('Order')
        ];
    }
    
    /**
     * @inheritdoc
     */
    protected function afterTableCreation()
    {
        $this->insert($this->tableName, ['id' => 1, 'name' => 'Freelance', 'enabled' => 1, 'order' => 10]);
        $this->insert($this->tableName, ['id' => 2, 'name' => 'Consultant', 'enabled' => 1, 'order' => 20]);
        $this->insert($this->tableName, ['id' => 3, 'name' => 'Entrepreneur', 'enabled' => 1, 'order' => 30]);
        $this->insert($this->tableName, ['id' => 4, 'name' => 'Teacher/researcher/university collaborator', 'enabled' => 1, 'order' => 40]);
        $this->insert($this->tableName, ['id' => 5, 'name' => 'Employee/collaborator of an organization (enterprise, entity, etc.)', 'enabled' => 1, 'order' => 50]);
        $this->insert($this->tableName, ['id' => 6, 'name' => 'Other', 'enabled' => 1, 'order' => 1000]);
    }
}
