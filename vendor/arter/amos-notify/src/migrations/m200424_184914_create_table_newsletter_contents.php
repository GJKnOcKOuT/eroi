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
 * @package    arter\amos\notify\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationTableCreation;

/**
 * Class m200424_184914_create_table_newsletter_contents
 */
class m200424_184914_create_table_newsletter_contents extends AmosMigrationTableCreation
{
    /**
     * @inheritdoc
     */
    protected function setTableName()
    {
        $this->tableName = '{{%notification_newsletter_contents}}';
    }

    /**
     * @inheritdoc
     */
    protected function setTableFields()
    {
        $this->tableFields = [
            'id' => $this->primaryKey(),
            'newsletter_id' => $this->integer()->notNull()->comment('Newsletter Id'),
            'newsletter_contents_conf_id' => $this->integer()->notNull()->comment('Newsletter Contents Conf Id'),
            'content_id' => $this->integer()->notNull()->comment('Content Id'),
            'order' => $this->smallInteger()->unsigned()->notNull()->comment('Order'),
        ];
        $this->setAddCreatedUpdatedFields(true);
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
        $this->createIndex('newsletter_contents_all_index', $this->tableName, ['newsletter_id', 'newsletter_contents_conf_id', 'content_id']);
        $this->createIndex('newsletter_contents_index', $this->tableName, ['newsletter_id', 'newsletter_contents_conf_id']);
        $this->createIndex('newsletter_index', $this->tableName, ['newsletter_id']);
    }

    /**
     * @inheritdoc
     */
    protected function addForeignKeys()
    {
        $this->addForeignKey('fk_newsletter_contents_newsletter', $this->tableName, 'newsletter_id', 'notification_newsletter', 'id');
        $this->addForeignKey('fk_newsletter_contents_newsletter_contents_conf', $this->tableName, 'newsletter_contents_conf_id', 'notification_newsletter_contents_conf', 'id');
    }
}
