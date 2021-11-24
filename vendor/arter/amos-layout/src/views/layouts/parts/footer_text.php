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
 * @package    arter\amos\core
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\icons\AmosIcons;
use yii\helpers\Html;

?>
<?php if ((isset(Yii::$app->params['footerText'])) && (Yii::$app->params['footerText'])): ?>
<div class="footer-space">
    <div class="footer-text-container">
        <div class="footer-text">
            <div class="container">
                <p class="power-by-open">Powered by OPEN 2.0</p>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php
$socialModule = \Yii::$app->getModule('social');
if (!is_null($socialModule) && class_exists('\kartik\social\GoogleAnalytics')):
    if (!empty($socialModule->googleAnalytics)):
        echo \kartik\social\GoogleAnalytics::widget([]);
    endif;
endif;
?>
