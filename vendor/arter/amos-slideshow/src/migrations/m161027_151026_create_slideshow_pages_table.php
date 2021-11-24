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
 * @package    arter\amos\slideshow
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationTableCreation;

/**
 * Class m161027_151026_create_slideshow_pages_table
 * Handles the creation for table `slideshow_pages`.
 */
class m161027_151026_create_slideshow_pages_table extends AmosMigrationTableCreation
{
    protected function setTableName()
    {
        $this->tableName = '{{%slideshow_pages}}';
    }

    protected function setTableFields()
    {
        $this->tableFields = [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'pageContent' => $this->text()->notNull(),
            'ordinal' => $this->smallInteger()->notNull(),
            'slideshow_id' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->null()->defaultValue(null),
            'updated_at' => $this->dateTime()->null()->defaultValue(null),
            'deleted_at' => $this->dateTime()->null()->defaultValue(null),
            'created_by' => $this->integer()->null()->defaultValue(null),
            'updated_by' => $this->integer()->null()->defaultValue(null),
            'deleted_by' => $this->integer()->null()->defaultValue(null)
        ];
    }

    /**
     * @inheritdoc
     */
    protected function addForeignKeys()
    {
        $this->addForeignKey('fk_' . $this->getRawTableName() . '_slideshow_id', $this->tableName, 'slideshow_id', 'slideshow', 'id');
    }
}
