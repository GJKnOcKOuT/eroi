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
 * @package    arter\amos\core\interfaces
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\interfaces;

interface CmsModuleInterface {

    /**
     * @return string The name of the search model class
     */
    public static function getModelSearchClassName();

    /**
     * @return string The name of the main model class
     */
    public static function getModelClassName();
}
