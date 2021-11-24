<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


use yii\db\Migration;

class m160609_090908_add_access_columns extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        // define all table names you want to equip with access control
        $tableNames = ['{%table}', '{%table}'];

        // add the access control columns to the defined tables
        foreach ($tableNames as $tableName) {
            $this->addColumn($tableName, 'access_owner', 'INT(11) NULL');
            $this->addColumn($tableName, 'access_domain', 'VARCHAR(255) NULL');
            $this->addColumn($tableName, 'access_read', 'VARCHAR(255) NULL');
            $this->addColumn($tableName, 'access_update', 'VARCHAR(255) NULL');
            $this->addColumn($tableName, 'access_delete', 'VARCHAR(255) NULL');
        }
    }

    public function safeDown()
    {
        echo "m160609_090908_add_access_columns cannot be reverted.\n";

        return false;
    }
}
