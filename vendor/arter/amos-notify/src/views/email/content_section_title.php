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
 * @var string $title
 */
if($section_title or $section_description) {
    $notifyModule = AmosNotify::instance();
?>

<!-- TITOLO SEZIONE : BEGIN -->
<tr>
    <td style="padding-top:15px;" width="100%">
    <table cellspacing="0" cellpadding="0" border="0" align="center" class="email-container" width="100%" style="width:100%">
        <?php if ($section_title) { ?>
            <tr>
	            <td bgcolor="<?= $notifyModule->mailThemeColor['bgPrimary'] ?>" style="font-family:sans-serif; color:#FFF; font-weight:bold; font-size:18px; padding:5px 10px; text-transform: uppercase; width:520px"><p style="margin:8px 0;"><?= ucfirst($section_title) ?></p></td>            </tr>
        <?php } // $section_title ?>
        <?php if ($section_description) { ?>
            <tr>
                <td style="font-family:sans-serif; font-size:14px; padding:5px 10px; width:520px"><p style="margin:8px 0;"><?= $section_description ?></p></td>
            </tr>
        <?php } // $section_description ?>
    </table>               
    </td>  
</tr>
<!-- TITOLO SEZIONE : END -->
<?php } // if
