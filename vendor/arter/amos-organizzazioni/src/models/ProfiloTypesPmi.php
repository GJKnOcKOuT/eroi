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
 * @package    arter\amos\organizzazioni\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\organizzazioni\models;

/**
 * Class ProfiloTypesPmi
 * This is the model class for table "organizations_types_pmi".
 * @package arter\amos\organizzazioni\models
 */
class ProfiloTypesPmi extends \arter\amos\organizzazioni\models\base\ProfiloTypesPmi
{
    const TYPE_CAT_GENERIC = 0;
    const TYPE_CAT_ENTE_AZIENDA_PUBBLICA = 1;
    const TYPE_CAT_PRIVATO = 3;
    const TYPE_CAT_ALTRO_ENTE = 2;
    const TYPE_CAT_GENERIC_PUBBLICO = 4;
}
