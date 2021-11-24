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
 * @package    arter\amos\layout
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\layout\assets\BaseAsset;

$asset = BaseAsset::register($this);
?>
<?php if ((isset(Yii::$app->params['footerSponsors'])) && (Yii::$app->params['footerSponsors'])): ?>
    <div class="footer-sponsor-container">
        <div class="footer-sponsors col-xs-12">
            <div class="sponsor">
                <img src="<?= $asset->baseUrl ?>/img/sponsors/unione-eu.jpg">
            </div>
            <div class="sponsor">
                <img src="<?= $asset->baseUrl ?>/img/sponsors/logo-rep.jpg">
            </div>
            <div class="sponsor">
                <img src="<?= $asset->baseUrl ?>/img/sponsors/logo-regione.jpg">
            </div>
            <div class="sponsor">
                <img src="<?= $asset->baseUrl ?>/img/sponsors/logo-fesr.jpg">
            </div>
        </div>
    </div>
<?php endif; ?>