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


/**
 * Class m180917_080000_add_data_countries_deleted*/
class m180917_080000_add_data_countries_deleted extends AmosMigrationPermissions
{
    public function safeUp() {

        $this->batchInsert(
            "istat_nazioni",
            [ 'id',  'nome',  'nome_inglese',  'codice_catastale',  'istat_continenti_id', 'data_soppressione', 'soppressa'],
            [
                [ '2000061',  'Hong Kong',  'Hong Kong',  'Z221',  3, '1997-07-01', 1],
            ]
        );

        return true;

    }

    public function safeDown() {

        /**
         * This will remove all data and columns inserted above
         */

            $this->delete(
                "istat_nazioni",
                [ "id" => 2000061 ]
            );

        return true;
    }

}