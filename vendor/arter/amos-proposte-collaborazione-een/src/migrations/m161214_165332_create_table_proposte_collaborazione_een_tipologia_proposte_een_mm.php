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


use arter\amos\core\migration\AmosMigrationTableCreation;

class m161214_165332_create_table_proposte_collaborazione_een_tipologia_proposte_een_mm extends AmosMigrationTableCreation
{
    /**
     * @inheritdoc
     */
    protected function setTableName()
    {
        $this->tableName = '{{%proposte_collaborazione_een_tipologia_proposte_een_mm}}';
    }
    
    /**
     * @inheritdoc
     */
    protected function setTableFields()
    {
        $this->tableFields = [
            'id' => $this->primaryKey(),
            'proposte_collaborazione_een_id' => $this->integer()->notNull(),
            'tipologia_proposte_een_id' => $this->integer()->notNull()
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
        $this->addForeignKey('fk_proposte_collaborazione_een_tipologia_proposte_een_mm10', $this->tableName, 'proposte_collaborazione_een_id', 'proposte_collaborazione_een', 'id');
        $this->addForeignKey('fk_tipologia_proposte_een_proposte_di_collaborazione_een_mm10', $this->tableName, 'tipologia_proposte_een_id', 'tipologia_proposte_een', 'id');
    }
}
