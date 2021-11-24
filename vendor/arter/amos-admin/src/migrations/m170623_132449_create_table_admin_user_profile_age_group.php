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
 * Class m170623_132449_create_table_admin_user_profile_age_group
 */
class m170623_132449_create_table_admin_user_profile_age_group extends AmosMigrationTableCreation
{
    /**
     * @inheritdoc
     */
    protected function setTableName()
    {
        $this->tableName = '{{%user_profile_age_group}}';
    }
    
    /**
     * @inheritdoc
     */
    protected function setTableFields()
    {
        $this->tableFields = [
            'id' => $this->primaryKey(),
            'age_group' => $this->string(255)->notNull()->comment('Age Group'),
            'enabled' => $this->boolean()->notNull()->comment('Enabled'),
            'order' => $this->smallInteger()->notNull()->comment('Order')
        ];
    }
    
    /**
     * @inheritdoc
     */
    protected function afterTableCreation()
    {
        $this->insert($this->tableName, ['id' => 1, 'age_group' => '18-25', 'enabled' => 1, 'order' => 10]);
        $this->insert($this->tableName, ['id' => 2, 'age_group' => '26-35', 'enabled' => 1, 'order' => 20]);
        $this->insert($this->tableName, ['id' => 3, 'age_group' => '36-45', 'enabled' => 1, 'order' => 30]);
        $this->insert($this->tableName, ['id' => 4, 'age_group' => '46-55', 'enabled' => 1, 'order' => 40]);
        $this->insert($this->tableName, ['id' => 5, 'age_group' => '56-65', 'enabled' => 1, 'order' => 50]);
        $this->insert($this->tableName, ['id' => 6, 'age_group' => '>65', 'enabled' => 1, 'order' => 60]);
    }
}
