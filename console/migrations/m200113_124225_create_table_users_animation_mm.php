<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\platform\common\console\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationTableCreation;

/**
 * Class m200113_124225_create_table_users_animation_mm
 */
class m200113_124225_create_table_users_animation_mm extends AmosMigrationTableCreation {

    /**
     * @inheritdoc
     */
    protected function setTableName()
    {
        $this->tableName = '{{%users_animation_mm}}';
    }

    /**
     * @inheritdoc
     */
    protected function setTableFields()
    {
        $this->tableFields = [
            'id' => $this->primaryKey(),
            'partnership_profile_id' => $this->integer()->notNull()->comment('Partnership Profiles ID'),
            'user_id' => $this->integer()->notNull()->comment('User ID'),
            'interested' => $this->integer(1)->defaultValue(0)->comment('Interested'),
            'select_keyword' => $this->string(255)->notNull()->comment('Select Keyword')

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
        $this->addForeignKey('fk_users_animation_mm_partnership_profile', $this->tableName, 'partnership_profile_id', 'partnership_profiles', 'id');
        $this->addForeignKey('fk_users_animation_mm_user', $this->tableName, 'user_id', 'user', 'id');
    }

}
