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
 * @package    arter\amos\socialauth
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\socialauth\Module;
?>
<div class="social-auth-bar">
    <?php
    foreach ($providers as $providerName=>$config) {
        $lowCaseName = strtolower($providerName);

        echo Html::a(
                AmosIcons::show($lowCaseName) . Module::t('amosadmin', 'Connect'),
                '/socialauth/social-auth/link-user?provider=' . $lowCaseName,
                ['class' => 'btn btn-navigation-primary']);
    }
    ?>
</div>
