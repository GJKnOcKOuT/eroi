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

$urlIcon = \Yii::$app->params['platform']['frontendUrl']. $icon;
$colors =  \arter\amos\notificationmanager\utility\NotifyUtility::getColorNetwork($color);
?>

<tr>
    <td colspan="2" style="padding:10px 0">
        <table width="100%">
            <tr>
                <td valign="top" width="25">
                    <img src="<?= $urlIcon ?>"  height="20" border="0" align="center">
                </td>
                <td>
                    <strong style="font-family:sans-serif; font-size:16px; color:<?= $colors[1]?>; text-transform:uppercase;"><?= ucfirst($title) ?></strong>
                </td>
            </tr>
        </table>
    </td>
</tr>