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
 * @package    arter\amos\comuni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 * Class m181113_130010_aggiunta_codice_catastale_serbia
 * Aggiunta codice catastale Serbia, Repubblica di
 */
class m181113_130010_aggiunta_codice_catastale_serbia extends \yii\db\Migration
{

    private function updateValues($arrayVariazioni) {

        foreach($arrayVariazioni as $istatCodiciCatastali) {
            /**
             * Aggiorno il codice catastale contenuto in $istatCodiciCatastali[1]
             * per ogni comune con codice istat (id) contenuto in $istatCodiciCatastali[0]
             */
            $this->update('istat_nazioni', ['codice_catastale' => $istatCodiciCatastali[1]], ['id' => $istatCodiciCatastali[0]]);
        }

    }

    public function safeUp()
    {
        $this->updateValues([
            ["271","Z158"],
        ]);
        return true;
    }

    public function safeDown()
    {
        echo "m181113_130010_aggiunta_codice_catastale_serbia cannot be reverted";
        return true;
    }

}