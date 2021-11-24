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


function phorum_htmlpurifier_save_settings()
{
    global $PHORUM;
    if (phorum_htmlpurifier_config_file_exists()) {
        echo "Cannot update settings, <code>mods/htmlpurifier/config.php</code> already exists. To change
        settings, edit that file. To use the web form, delete that file.<br />";
    } else {
        $config = phorum_htmlpurifier_get_config(true);
        if (!isset($_POST['reset'])) $config->mergeArrayFromForm($_POST, 'config', $PHORUM['mod_htmlpurifier']['directives']);
        $PHORUM['mod_htmlpurifier']['config'] = $config->getAll();
    }
    $PHORUM['mod_htmlpurifier']['wysiwyg'] = !empty($_POST['wysiwyg']);
    $PHORUM['mod_htmlpurifier']['suppress_message'] = !empty($_POST['suppress_message']);
    if(!phorum_htmlpurifier_commit_settings()){
        $error="Database error while updating settings.";
    } else {
        echo "Settings Updated<br />";
    }
}

function phorum_htmlpurifier_commit_settings()
{
    global $PHORUM;
    return phorum_db_update_settings(array("mod_htmlpurifier"=>$PHORUM["mod_htmlpurifier"]));
}

// vim: et sw=4 sts=4
