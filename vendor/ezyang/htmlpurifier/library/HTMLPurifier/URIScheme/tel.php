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


/**
 * Validates tel (for phone numbers).
 *
 * The relevant specifications for this protocol are RFC 3966 and RFC 5341,
 * but this class takes a much simpler approach: we normalize phone
 * numbers so that they only include (possibly) a leading plus,
 * and then any number of digits and x'es.
 */

class HTMLPurifier_URIScheme_tel extends HTMLPurifier_URIScheme
{
    /**
     * @type bool
     */
    public $browsable = false;

    /**
     * @type bool
     */
    public $may_omit_host = true;

    /**
     * @param HTMLPurifier_URI $uri
     * @param HTMLPurifier_Config $config
     * @param HTMLPurifier_Context $context
     * @return bool
     */
    public function doValidate(&$uri, $config, $context)
    {
        $uri->userinfo = null;
        $uri->host     = null;
        $uri->port     = null;

        // Delete all non-numeric characters, non-x characters
        // from phone number, EXCEPT for a leading plus sign.
        $uri->path = preg_replace('/(?!^\+)[^\dx]/', '',
                     // Normalize e(x)tension to lower-case
                     str_replace('X', 'x', $uri->path));

        return true;
    }
}

// vim: et sw=4 sts=4
