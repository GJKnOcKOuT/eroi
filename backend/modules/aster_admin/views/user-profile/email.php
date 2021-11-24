<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\amos\admin\views\user-profile\boxes
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;

/**
 * @var \arter\amos\admin\models\UserProfile $contactProfile
 * @var string $message
 * @var string $url
 * @var string $messageLink
 */
$createmessageparams = [
    'messages/' . $contactProfile->user_id,
];
$chatUrl = \Yii::$app->urlManager->createAbsoluteUrl($createmessageparams);
?>

<div>
    <div style="box-sizing:border-box;">
        <div class="corpo"
             style="border:1px solid #cccccc;padding:10px;margin-bottom:10px;background-color:#ffffff;margin-top:20px">

            <p><?= $message ?>  <a href="<?= $chatUrl ?>"><?= AmosAdmin::t('amosadmin', "#click_here"); ?></a> </p>

        </div>
    </div>
</div>
