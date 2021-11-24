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


require_once 'common.php';

$config = HTMLPurifier_Config::createDefault();
$config->set('HTML.Doctype', 'HTML 4.01 Strict');
$config->set('HTML.Allowed', 'b,a[href],br');
$config->set('CSS.AllowTricky', true);
$config->set('URI.Disable', true);
$serial = $config->serialize();

$result = unserialize($serial);
$purifier = new HTMLPurifier($result);
echo htmlspecialchars($purifier->purify('<b>Bold</b><br><i><a href="http://google.com">no</a> formatting</i>'));
