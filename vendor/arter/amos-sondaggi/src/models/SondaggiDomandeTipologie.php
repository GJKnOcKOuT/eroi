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
 * Class SondaggiDomandeTipologie
 * This is the model class for table "sondaggi_domande_tipologie".
 * @package arter\amos\sondaggi\models
 */
class SondaggiDomandeTipologie extends \arter\amos\sondaggi\models\base\SondaggiDomandeTipologie
{
    /**
     * @inheritdoc
     */
    public function representingColumn()
    {
        return [
            'tipologia',
        ];
    }
}
