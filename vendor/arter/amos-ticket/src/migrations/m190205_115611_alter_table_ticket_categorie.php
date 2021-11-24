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
 * @package    arter\amos\ticket\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigration;

/**
 * Class m190205_115611_alter_table_ticket_categorie
 */
class m190205_115611_alter_table_ticket_categorie extends AmosMigration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        if (\Yii::$app->db->getSchema()->getTableSchema('ticket_categorie')) {
            $this->addColumn('ticket_categorie', 'abilita_per_community', $this->boolean()->defaultValue(false)->notNull()->after('categoria_padre_id')->comment("Abilita visualizzazione per community"));
            $this->addColumn('ticket_categorie', 'community_id', $this->integer()->null()->defaultValue(null)->after('abilita_per_community')->comment("Categoria specifica per community"));
            $this->addForeignKey('ticket_categorie_community_id', 'ticket_categorie', 'community_id', 'community', 'id', 'NO ACTION', 'NO ACTION');
            echo "Column community_id and abilita_per_community and its foreign key added\n";
        } else {
            echo "Table ticket_categorie doesn't exist. Can't add column community_id and its foreign key and column abilita_per_community\n";
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        if (\Yii::$app->db->getSchema()->getTableSchema('ticket_categorie')) {
            if (\Yii::$app->db->getSchema()->getTableSchema('ticket_categorie')->getColumn('community_id')) {
                $this->dropForeignKey('ticket_categorie_community_id', 'ticket_categorie');
                $this->dropColumn('ticket_categorie', 'community_id');
                echo "Column community_id and its foreign key deleted from table ticket_categorie\n";
            } else {
                echo "Can't find column community_id inside table ticket_categorie\n";
            }
            if (\Yii::$app->db->getSchema()->getTableSchema('ticket_categorie')->getColumn('abilita_per_community')) {
                $this->dropColumn('ticket_categorie', 'abilita_per_community');
                echo "Column abilita_per_community and its foreign key deleted from table ticket_categorie\n";
            } else {
                echo "Can't find column abilita_per_community inside table ticket_categorie\n";
            }
        } else {
            echo "Can't find table ticket_categorie\n";
        }
        return true;
    }
}
