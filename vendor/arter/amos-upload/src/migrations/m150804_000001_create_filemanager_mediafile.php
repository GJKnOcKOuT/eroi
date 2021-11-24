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
 * @package    arter\amos\upload
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Schema;

class m150804_000001_create_filemanager_mediafile extends \yii\db\Migration
{
    const TABLE = '{{%filemanager_mediafile}}';

    public function up()
    {
        if ($this->db->schema->getTableSchema(self::TABLE, true) === null) {
   
        $this->createTable(self::TABLE, [
            'id' => Schema::TYPE_PK,
            'filename' => Schema::TYPE_STRING . '(255) NOT NULL',
            'type' => Schema::TYPE_STRING . '(255) NOT NULL',
            'url' => Schema::TYPE_TEXT . ' NOT NULL',
            'alt' => Schema::TYPE_TEXT,
            'size' => Schema::TYPE_STRING . '(255) NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'thumbs' => Schema::TYPE_TEXT,
            'created_at' => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'Creato il'",
            'updated_at' => Schema::TYPE_INTEGER . " NULL DEFAULT NULL COMMENT 'Aggiornato il'",                                           
        ], $this->db->driverName === 'mysql' ? 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB AUTO_INCREMENT=1' : null);
        }
        else{
            echo "Nessuna creazione eseguita in quanto la tabella esiste già";
            return true;
        }
    }

    public function down()
    {
        if ($this->db->schema->getTableSchema(self::TABLE, true) !== null) {
        $this->dropTable(self::TABLE);
        }
        else{
            echo "Nessuna cancellazione eseguita in quanto la tabella non esiste";
            return true;
        }
    }

}