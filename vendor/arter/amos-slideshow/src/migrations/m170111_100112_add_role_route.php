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

use yii\db\Migration;

/**
 * Handles the creation for table `slideshow`.
 */
class m170111_100112_add_role_route extends Migration {

    const TABLE = '{{%slideshow_route}}';

    /**
     * Use this instead of function up().
     * @see \Yii\db\Migration::safeUp() for more info.
     */
    public function safeUp() {

        if ($this->db->schema->getTableSchema(self::TABLE, true) !== null) {
            try {
                $this->execute("ALTER TABLE `slideshow_route` ADD COLUMN `role` VARCHAR(255) NULL DEFAULT 'TUTTI' COMMENT 'Ruolo che vedrà lo slideshow' AFTER `slideshow_id`;");
            } catch (Exception $e) {
                echo "Errore durante l'aggiunta della colonna role della tabella " . self::TABLE . "\n";
                echo $e->getMessage() . "\n";
                return false;
            }
        } else {
            echo "Nessuna creazione eseguita in quanto la tabella " . self::TABLE . " non esiste \n";
        }

        return true;
    }

    /**
     * Use this instead of function down().
     * @see \Yii\db\Migration::safeDown() for more info.
     */
    public function safeDown() {
        echo "Nessun down previsto";
        return true;
    }

}
