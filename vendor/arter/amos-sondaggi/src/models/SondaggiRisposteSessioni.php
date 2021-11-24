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
 * @package    arter\amos\sondaggi\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\sondaggi\models;

/**
 * Class SondaggiRisposteSessioni
 * This is the model class for table "sondaggi_risposte_sessioni".
 * @package arter\amos\sondaggi\models
 */
class SondaggiRisposteSessioni extends \arter\amos\sondaggi\models\base\SondaggiRisposteSessioni
{
    /**
     * @inheritdoc
     */
    public function representingColumn()
    {
        return [
            //inserire il campo o i campi rappresentativi del modulo
        ];
    }
}
