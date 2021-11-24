<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\platform\modules\aster_een\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationTableCreation;

/**
 * Class m201204_080500_create_table_een_tag_s3_tag_een_mm
 */
class m201204_080500_create_table_een_tag_s3_tag_een_mm extends AmosMigrationTableCreation {

    /**
     * @inheritdoc
     */
    protected function setTableName()
    {
        $this->tableName = '{{%een_tag_s3_tag_een_mm}}';
    }

    /**
     * @inheritdoc
     */
    protected function setTableFields()
    {
        $this->tableFields = [
            'id' => $this->primaryKey(),
            'een_tag_een_id' => $this->integer()->notNull()->comment('TAG EEN'),
            'tag_s3_id' => $this->integer()->null()->comment('TAG S3'),
            'description' => $this->string(255)->null()->comment('Descrizione')

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
    protected function addForeignKeys()
    {
        $this->addForeignKey('fk_een_tag_een', $this->tableName, 'een_tag_een_id', 'een_tag_een', 'id');
        $this->addForeignKey('fk_tag_s3', $this->tableName, 'tag_s3_id', 'tag', 'id');
    }

}
