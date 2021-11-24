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
 * Initializes the appropriate configuration from either a PHP file
 * or a module configuration value
 * @return Instance of HTMLPurifier_Config
 */
function phorum_htmlpurifier_get_config($default = false)
{
    global $PHORUM;
    $config_exists = phorum_htmlpurifier_config_file_exists();
    if ($default || $config_exists || !isset($PHORUM['mod_htmlpurifier']['config'])) {
        $config = HTMLPurifier_Config::createDefault();
        include(dirname(__FILE__) . '/config.default.php');
        if ($config_exists) {
            include(dirname(__FILE__) . '/config.php');
        }
        unset($PHORUM['mod_htmlpurifier']['config']); // unnecessary
    } else {
        $config = HTMLPurifier_Config::create($PHORUM['mod_htmlpurifier']['config']);
    }
    return $config;
}

function phorum_htmlpurifier_config_file_exists()
{
    return file_exists(dirname(__FILE__) . '/config.php');
}

// vim: et sw=4 sts=4
