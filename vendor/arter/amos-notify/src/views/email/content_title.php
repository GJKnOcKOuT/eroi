<?php

use arter\amos\notificationmanager\AmosNotify;

/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\notificationmanager\views\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 * @var string $title
 */

$urlIcon = Yii::$app->params['platform']['frontendUrl']. $icon;
$notifyModule = AmosNotify::instance();
?>

<!-- TITOLO VERDE : BEGIN -->
<tr>
    <td style="padding-top:15px;" width="100%">
    <table cellspacing="0" cellpadding="0" border="0" align="center" class="email-container" width="100%" style="width:100%">
        <tr>
	        <td bgcolor="<?= $notifyModule->mailThemeColor['bgPrimaryDark'] ?>" align="center" style="width:40px; padding:5px"><img src="<?= $urlIcon ?>" height="20" border="0" align="center"></td>
	        <td bgcolor="<?= $notifyModule->mailThemeColor['bgPrimary'] ?>" style="font-family:sans-serif; color:<?= $notifyModule->mailThemeColor['textPrimary'] ?>; font-weight:bold; font-size:18px; padding:5px 10px; text-transform: uppercase; width:520px"><p style="margin:8px 0;"><?= ucfirst($title) ?></p></td>
        </tr>
    </table>               
    </td>  
</tr>
<!-- TITOLO VERDE : END -->