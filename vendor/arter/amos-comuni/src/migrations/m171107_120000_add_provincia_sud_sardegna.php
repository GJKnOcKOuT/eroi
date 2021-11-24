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

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;


/**
 * Class m171031_160001_add_auth_item_importatore_comuni*/
class m171107_120000_add_provincia_sud_sardegna extends AmosMigrationPermissions
{
    public function safeUp() {
        $this->batchInsert(
            "istat_province",
            [ 'id',  'nome',  'sigla',  'capoluogo',  'soppressa',  'istat_citta_metropolitane_id',  'istat_regioni_id'],
            [[ '111',  'Sud Sardegna',  'SU',  '0',  '0',  NULL,  '20'] ]
        );
    }

    public function safeDown() {
        $this->delete(
            "istat_province",
            [ "id" => "111",  ]
        );
    }
}