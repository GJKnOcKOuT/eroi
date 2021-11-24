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
 * @package    arter\amos\cwh\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\cwh\models;

/**
 * Class CwhRegolePubblicazione
 * This is the model class for table "cwh_regole_pubblicazione".
 * @package arter\amos\cwh\models
 */
class CwhRegolePubblicazione extends \arter\amos\cwh\models\base\CwhRegolePubblicazione
{
    const ALL_USERS = 1;
    const ALL_USERS_WITH_TAGS = 2;
    const ALL_USERS_IN_DOMAINS = 3;
    const ALL_USERS_IN_DOMAINS_WITH_TAGS = 4;

    public static function find()
    {
        return new \arter\amos\cwh\models\query\CwhRegolePubblicazioneQuery(get_called_class());
    }
}
