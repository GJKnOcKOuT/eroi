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
 * @package    arter\amos\partnershipprofiles\base
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\partnershipprofiles\base;

/**
 * Class PartnershipProfilesModules
 * @package arter\amos\partnershipprofiles\base
 */
class PartnershipProfilesModules
{
    const PART_PROF_MODULE_NAME = 'partnershipprofiles';
    const PART_PROF_ADMIN_MODULE_NAME = 'partnershipprofilesadmin';
    const EXPR_OF_INT_MODULE_NAME = 'expressionsofinterest';
    const EXPR_OF_INT_ADMIN_MODULE_NAME = 'expressionsofinterestadmin';
    const PART_PROF_EXPR_OF_INT_MODULE_NAME = 'partnerprofexprofint';

    public static function getAllModuleNames()
    {
        return [
            self::PART_PROF_MODULE_NAME,
            self::PART_PROF_ADMIN_MODULE_NAME,
            self::EXPR_OF_INT_MODULE_NAME,
            self::EXPR_OF_INT_ADMIN_MODULE_NAME,
            self::PART_PROF_EXPR_OF_INT_MODULE_NAME
        ];
    }
}
