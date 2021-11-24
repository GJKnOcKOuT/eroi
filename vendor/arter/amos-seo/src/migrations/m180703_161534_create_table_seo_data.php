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
 * @package    arter\amos\seo\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationTableCreation;

/**
 * Class m180703_161534_create_table_seo_data
 */
class m180703_161534_create_table_seo_data extends AmosMigrationTableCreation
{
    /**
     * @inheritdoc
     */
    protected function setTableName()
    {
        $this->tableName = '{{%seo_data}}';
    }

    /**
     * @inheritdoc
     */
    protected function setTableFields()
    {
        $this->tableFields = [
            'id' => $this->primaryKey(),
            'classname' => $this->string(255)->null()->comment('Content Class Name'),
            'content_id' => $this->integer(11)->comment('Table Content id'),
            'pretty_url' => $this->string(255)->null()->unique()->comment('Seo Pretty Url'),
            'meta_title' => $this->text()->null(),
            'meta_description' => $this->text()->null(),
            'meta_keywords' => $this->text()->null(),
            'og_title' => $this->text()->null(),
            'og_description' => $this->text()->null(),
            'og_type' => $this->string(255)->null(),
            'meta_robots' => $this->string(255)->null(),
            'meta_googlebot' => $this->string(255)->null(),
            'unavailable_after_date' => $this->dateTime()->null()->comment('Begin Date And Hour'),
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

    
    protected function afterForeignKeysAdd() {
        $this->createIndex(
            'idx-classname-content_id',
            $this->tableName,
            'classname,content_id',
            true //unique
        );
    }
}
