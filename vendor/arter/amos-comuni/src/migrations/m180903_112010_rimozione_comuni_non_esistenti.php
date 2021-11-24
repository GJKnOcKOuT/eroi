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
 * Class m180903_112010_rimozione_comuni_non_esistenti
 * Questa migration rimuove i comuni non esistenti (verifica effettuata anche manualmente)
 * nella lista estratta dal sito dell'agenzia delle entrate ma presenti nei file
 * istat importati.
 */
class m180903_112010_rimozione_comuni_non_esistenti extends \yii\db\Migration
{

    public function safeUp()
    {

        $this->delete('istat_comuni', ['id' => 27810]);
        $this->delete('istat_comuni', ['id' => 701806]);
        $this->delete('istat_comuni', ['id' => 702802]);

        return true;
    }

    public function safeDown()
    {
        echo "m180903_112010_rimozione_comuni_non_esistenti cannot be reverted";
        return true;
    }

}