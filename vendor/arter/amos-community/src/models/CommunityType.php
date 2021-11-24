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
 * @package    arter\amos\community
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\community\models;

/**
 * Class CommunityType
 * This is the model class for table "community_types".
 * @package arter\amos\community\models
 */
class CommunityType extends \arter\amos\community\models\base\CommunityType
{
    /**
     * Constants for ID of the three community types
     */
    const COMMUNITY_TYPE_OPEN = 1;
    const COMMUNITY_TYPE_PRIVATE = 2;
    const COMMUNITY_TYPE_CLOSED = 3;
}
