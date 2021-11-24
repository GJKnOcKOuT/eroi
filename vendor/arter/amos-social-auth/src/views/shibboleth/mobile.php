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

$userProfile = json_encode($user->toArray([
    'id',
    'username',
    'email',
    'accessToken',
    'fcmToken',
    'slimProfile',
    'userImage',
]));
?>

<h1><?= Yii::t('socialauth', 'Caricamento....'); ?></h1>
<script type="text/javascript">
    if(typeof webViewCallback == 'function') {
        webViewCallback(<?= $userProfile; ?>);
    }
</script>