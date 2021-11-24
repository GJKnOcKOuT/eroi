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
 * @package    arter\amos\organizzazioni\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\libs\common\MigrationCommon;
use yii\db\Migration;

/**
 * Class m180517_100613_fix_add_cwh_organizzazioni
 */
class m180517_100613_fix_add_cwh_organizzazioni extends Migration
{
    private $tablename = 'cwh_config';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableSchema = $this->db->schema->getTableSchema($this->tablename);
        $rawSqlColumn = $tableSchema->getColumn('raw_sql');
        if (!is_null($rawSqlColumn)) {
            MigrationCommon::printConsoleMessage('La colonna raw_sql esiste nella tabella ' . $this->tablename . '. Aggiorno il valore.');
            try {
                $this->update($this->tablename,
                    [
                        'classname' => arter\amos\organizzazioni\models\Profilo::className(),
                        'tablename' => 'profilo',
                        'raw_sql' => "select concat('profilo-',`profilo`.`id`) AS `id`, 7 AS `cwh_config_id`, `profilo`.`id` AS `record_id`, 'arter\\\\amos\organizzazioni\\\\models\\\\Profilo' AS `classname`, 1 AS `visibility`, `profilo`.`created_at` AS `created_at`, `profilo`.`updated_at` AS `updated_at`, `profilo`.`deleted_at` AS `deleted_at`, `profilo`.`created_by` AS `created_by`, `profilo`.`updated_by` AS `updated_by`, `profilo`.`deleted_by` AS `deleted_by` from `profilo`"
                    ], ['id' => 7,]);

            } catch (\Exception $e) {
                MigrationCommon::printConsoleMessage("Errore durante l'aggiornamento della configurazione CWH per amos-organizzazioni");
                MigrationCommon::printConsoleMessage($e->getMessage());
                return false;
            }
        } else {
            MigrationCommon::printConsoleMessage('La colonna raw_sql non esiste nella tabella ' . $this->tablename . '. Nulla da modificare.');
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        return true;
    }
}
