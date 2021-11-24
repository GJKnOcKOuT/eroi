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
 * Class m190121_095810_aggiunta_codici_catastali_stati_mancanti
 * Aggiunta codici catastali mancanti in stati
 */
class m190121_095810_aggiunta_codici_catastali_stati_mancanti extends \yii\db\Migration
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
            ["270","Z159"],
            ["272","Z160"],
            ["324","Z161"],
            ["467","Z907"],
            ["959","Z122"],
            ["925","Z124"],
            ["999","Z999"],
        ]);
        return true;
    }

    public function safeDown()
    {
        echo "m190121_095810_aggiunta_codici_catastali_stati_mancanti cannot be reverted";
        return true;
    }

}