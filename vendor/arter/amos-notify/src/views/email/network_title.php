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
 * @package    arter\amos\notificationmanager\views\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\notificationmanager\AmosNotify;

/**
 * @var integer $contents_number
 */

$colors =  \arter\amos\notificationmanager\utility\NotifyUtility::getColorNetwork($color);
$urlIcon = \Yii::$app->params['platform']['frontendUrl'].\arter\amos\notificationmanager\utility\NotifyUtility::getIconNetwork($color);

?>

<tr>
    <td colspan="2" style="padding-top:15px;" width="100%">
        <table cellspacing="0" cellpadding="0" border="0" align="center" class="email-container" width="100%" style="width:100%">
            <tr>
                <td bgcolor=" <?= $colors[0] ?>" align="center" style="width:40px; padding:5px"><img src="<?= $urlIcon ?>" height="20" border="0" align="center"></td>
                <td bgcolor=" <?= $colors[1] ?>" style="font-family:sans-serif; color:#FFF; font-weight:bold; font-size:16px; padding:5px 10px; width:520px">
                    <p style="margin:8px 0;"><?= $modelNetwork->getTitle() ?></p>
                </td>
            </tr>
        </table>
    </td>
</tr>

<tr>
    <td colspan="2" style="padding-bottom:10px;">
        <table cellspacing="0" cellpadding="0" border="0" align="center"   class="email-container" width="100%">
            <tr>
                <td bgcolor="#FFFFFF" style="padding:10px 15px 10px 15px; border-left:5px solid <?= $colors[2] ?>">
                    <table width="100%">