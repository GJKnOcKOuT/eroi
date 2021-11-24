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
 * Validates a URI in CSS syntax, which uses url('http://example.com')
 * @note While theoretically speaking a URI in a CSS document could
 *       be non-embedded, as of CSS2 there is no such usage so we're
 *       generalizing it. This may need to be changed in the future.
 * @warning Since HTMLPurifier_AttrDef_CSS blindly uses semicolons as
 *          the separator, you cannot put a literal semicolon in
 *          in the URI. Try percent encoding it, in that case.
 */
class HTMLPurifier_AttrDef_CSS_URI extends HTMLPurifier_AttrDef_URI
{

    public function __construct()
    {
        parent::__construct(true); // always embedded
    }

    /**
     * @param string $uri_string
     * @param HTMLPurifier_Config $config
     * @param HTMLPurifier_Context $context
     * @return bool|string
     */
    public function validate($uri_string, $config, $context)
    {
        // parse the URI out of the string and then pass it onto
        // the parent object

        $uri_string = $this->parseCDATA($uri_string);
        if (strpos($uri_string, 'url(') !== 0) {
            return false;
        }
        $uri_string = substr($uri_string, 4);
        if (strlen($uri_string) == 0) {
            return false;
        }
        $new_length = strlen($uri_string) - 1;
        if ($uri_string[$new_length] != ')') {
            return false;
        }
        $uri = trim(substr($uri_string, 0, $new_length));

        if (!empty($uri) && ($uri[0] == "'" || $uri[0] == '"')) {
            $quote = $uri[0];
            $new_length = strlen($uri) - 1;
            if ($uri[$new_length] !== $quote) {
                return false;
            }
            $uri = substr($uri, 1, $new_length - 1);
        }

        $uri = $this->expandCSSEscape($uri);

        $result = parent::validate($uri, $config, $context);

        if ($result === false) {
            return false;
        }

        // extra sanity check; should have been done by URI
        $result = str_replace(array('"', "\\", "\n", "\x0c", "\r"), "", $result);

        // suspicious characters are ()'; we're going to percent encode
        // them for safety.
        $result = str_replace(array('(', ')', "'"), array('%28', '%29', '%27'), $result);

        // there's an extra bug where ampersands lose their escaping on
        // an innerHTML cycle, so a very unlucky query parameter could
        // then change the meaning of the URL.  Unfortunately, there's
        // not much we can do about that...
        return "url(\"$result\")";
    }
}

// vim: et sw=4 sts=4
