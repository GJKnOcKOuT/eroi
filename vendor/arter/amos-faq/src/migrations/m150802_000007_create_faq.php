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
 * @package    arter\amos\faq
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Schema;

class m150802_000007_create_faq extends \yii\db\Migration
{

    const TABLE = '{{%faq}}';

    public function up()
    {
        if ($this->db->schema->getTableSchema(self::TABLE, true) === null) {
            $this->createTable(self::TABLE, [
                'id' => Schema::TYPE_PK,
                'domanda' => Schema::TYPE_TEXT . " COMMENT 'Domanda'",
                'risposta' => Schema::TYPE_TEXT . " COMMENT 'Risposta'",
                'order' => Schema::TYPE_INTEGER . " DEFAULT '100' COMMENT 'Ordinamento'",
                'rotte' => Schema::TYPE_TEXT . " NULL DEFAULT NULL COMMENT 'Rotte'",
                'created_at' => Schema::TYPE_DATETIME . " NULL DEFAULT NULL COMMENT 'Creato il'",
                'updated_at' => Schema::TYPE_DATETIME . " NULL DEFAULT NULL COMMENT 'Aggiornato il'",
                'deleted_at' => Schema::TYPE_DATETIME . " NULL DEFAULT NULL COMMENT 'Cancellato il'",
                'created_by' => Schema::TYPE_INTEGER . " NULL DEFAULT NULL COMMENT 'Creato da'",
                'updated_by' => Schema::TYPE_INTEGER . " NULL DEFAULT NULL COMMENT 'Aggiornato da'",
                'deleted_by' => Schema::TYPE_INTEGER . " NULL DEFAULT NULL COMMENT 'Cancellato da'",
                'version' => Schema::TYPE_INTEGER . " NULL DEFAULT NULL COMMENT 'Versione numero'",
                'faq_categories_id' => Schema::TYPE_INTEGER . " DEFAULT '0' COMMENT 'Id Categoria'",
                'faq_stato_id' => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'Id Stato'",
                'faq_widgets_id' => Schema::TYPE_INTEGER . " DEFAULT '0' COMMENT 'Id Widget'"
            ], $this->db->driverName === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB AUTO_INCREMENT=1' : null);
            $this->addForeignKey('fk_faq_faq_categories1', self::TABLE, 'faq_categories_id', 'faq_categories', 'id');
            $this->addForeignKey('fk_faq_faq_stato1', self::TABLE, 'faq_stato_id', 'faq_stato', 'id');
            $this->addForeignKey('fk_faq_faq_widgets1', self::TABLE, 'faq_widgets_id', 'faq_amos_widgets_mm', 'faq_id');
        } else {
            echo "Nessuna creazione eseguita in quanto la tabella esiste gia'";
            return true;
        }
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema(self::TABLE, true) !== null) {
            $this->dropForeignKey('fk_faq_faq_categories1', self::TABLE);
            $this->dropForeignKey('fk_faq_faq_stato1', self::TABLE);
            $this->dropForeignKey('fk_faq_faq_widgets1', self::TABLE);
            $this->dropTable(self::TABLE);
        } else {
            echo "Nessuna cancellazione eseguita in quanto la tabella non esiste";
            return true;
        }
    }

}
