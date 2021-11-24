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
 * @package    arter\amos\cwh
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Schema;

class m150803_000001_create_cwh_regole_pubblicazione extends \yii\db\Migration
{
    const TABLE = '{{%cwh_regole_pubblicazione}}';

    public function up()
    {
        if ($this->db->schema->getTableSchema(self::TABLE, true) === null) {
            $this->createTable(self::TABLE, [
                'id' => Schema::TYPE_PK,
                'nome' => Schema::TYPE_STRING . "(255) DEFAULT NULL COMMENT 'Codice'",
                'codice' => Schema::TYPE_STRING . " DEFAULT NULL",
                'created_at' => Schema::TYPE_DATETIME . " NULL DEFAULT NULL COMMENT 'Creato il'",
                'updated_at' => Schema::TYPE_DATETIME . " NULL DEFAULT NULL COMMENT 'Aggiornato il'",
                'deleted_at' => Schema::TYPE_DATETIME . " NULL DEFAULT NULL COMMENT 'Cancellato il'",
                'created_by' => Schema::TYPE_INTEGER . " NULL DEFAULT NULL COMMENT 'Creato da'",
                'updated_by' => Schema::TYPE_INTEGER . " NULL DEFAULT NULL COMMENT 'Aggiornato da'",
                'deleted_by' => Schema::TYPE_INTEGER . " NULL DEFAULT NULL COMMENT 'Cancellato da'",
                'version' => Schema::TYPE_INTEGER . " NULL DEFAULT NULL COMMENT 'Versione numero'",
            ], $this->db->driverName === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB AUTO_INCREMENT=1' : null);
        } else {
            echo "Nessuna creazione eseguita in quanto la tabella esiste gia'";
            return true;
        }
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema(self::TABLE, true) !== null) {
            $this->dropTable(self::TABLE);
        } else {
            echo "Nessuna cancellazione eseguita in quanto la tabella non esiste";
            return true;
        }
    }

}