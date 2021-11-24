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


namespace arter\amos\cwh\helpers;

use arter\amos\cwh\helpers\base\BaseEntitiesHelper;

class NetworkHelper extends BaseEntitiesHelper
{
    public static function getEntities($interfaceClassname = '\arter\amos\cwh\base\ModelNetworkInterface')
    {
        return parent::getEntities($interfaceClassname);
    }


}