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
$notifyModule = AmosNotify::instance();
?>

<div style="box-sizing:border-box;color:#000000;">
    <div style="padding:5px 10px;background-color: #F2F2F2;text-align:center;">
	    <h1 style="color:<?= $notifyModule->mailThemeColor['bgPrimary'] ?>;font-size:1.2em;margin:0;">            <?= AmosNotify::t('amosnotify', '#Platform_update') ?>
        </h1>
        <p style="font-size:1em;margin:0;margin-top:5px;">
            <?php
            if ($contents_number == 1):
                ?>
                <?= AmosNotify::t('amosnotify', '#There_is_content_interest', [$contents_number]) ?>
            <?php
            else:
                ?>
                <?= AmosNotify::t('amosnotify', '#There_is_content_interest_plural', [$contents_number]) ?>
            <?php
            endif;
            ?>
        </p>
    </div>
</div>
