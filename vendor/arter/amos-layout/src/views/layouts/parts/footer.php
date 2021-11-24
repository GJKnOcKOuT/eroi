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

//Pickup assistance params
$assistance = isset(\Yii::$app->params['assistance']) ? \Yii::$app->params['assistance'] : [];

//Check if is in email mode
$isMail = ((isset($assistance['type']) && $assistance['type'] == 'email') || (!isset($assistance['type']) && isset(\Yii::$app->params['email-assistenza']))) ? true : false;
$mailAddress = isset($assistance['email']) ? $assistance['email'] : (isset(\Yii::$app->params['email-assistenza']) ? \Yii::$app->params['email-assistenza'] : '');
?>

<?php if (isset(\Yii::$app->params['assistance-url'])): ?>
    <div class="assistance">
        <a href="<?= \Yii::$app->params['assistance-url'] ?>">
            <?= AmosIcons::show('email', ['class' => 'icon-assistance']) ?>
            <span><?= Yii::t('amoscore', 'Hai bisogno di assistenza?') ?></span>
            <span class="sr-only"><?= Yii::t('amoscore', 'Verrà aperta una nuova finestra') ?></span>
        </a>
    </div>
<?php elseif (isset(Yii::$app->modules['assistance-request'])): ?>
    <?= $this->renderFile('@vendor/arter/amos-assistance-request/src/views/_modal_form_request.php'); ?>
<?php else: ?>
    <?php if ((isset($assistance['enabled']) && $assistance['enabled']) || (!isset($assistance['enabled']) && isset(\Yii::$app->params['email-assistenza']))): ?>
        <div class="assistance">
            <a href="<?= $isMail ? 'mailto:' . $mailAddress : (isset($assistance['url']) ? $assistance['url'] : '') ?>">
                <?= AmosIcons::show('email', ['class' => 'icon-assistance']) ?>
                <span><?= Yii::t('amoscore', 'Hai bisogno di assistenza?'); ?></span>
                <span class="sr-only"><?= Yii::t('amoscore', 'Verrà aperta una nuova finestra') ?></span>
            </a>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?= $this->render("footer_text"); ?>

<?php
if ($socialModule = \Yii::$app->getModule('social') && class_exists('\kartik\social\GoogleAnalytics')):
    if (YII_ENV_PROD && !empty($socialModule->googleAnalytics)):
        echo \kartik\social\GoogleAnalytics::widget([]);
    endif;
endif;
?>