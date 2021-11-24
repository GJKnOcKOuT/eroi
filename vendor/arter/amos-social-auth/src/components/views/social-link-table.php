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
?>
<div class="social-auth-bar">
    <?php
    foreach ($providers as $providerName => $config) {
        $lowCaseName = strtolower($providerName);

        /**
         * @var $socialAccount SocialAuthUsers
         */
        $socialAccount = SocialAuthUsers::findOne([
            'provider' => $lowCaseName,
            'user_id' => Yii::$app->user->id
        ]);

        /**
         * Is this social linked
         */
        $socialLinked = (!$socialAccount || !$socialAccount->id);
        ?>
        <div class="social_checkws">
            <div class="header">
                <span style="float:left;">
                    <h4><?= $providerName ?></h4>
                </span>
                <div class="social-buttons-container">
                    <?php if(!$socialLinked) : ?>
                        <?= Html::a(
                                AmosIcons::show($lowCaseName),
                                '/socialauth/social-auth/link-user?provider=' . $lowCaseName, ['class' => 'btn btn-default']); ?>
                        <button type="button" class="btn btn-social collega-social" data-type="<?= $lowCaseName ?>">
                            <span class="fa fa-<?= $lowCaseName ?>"></span>
                            <span>
                                <?= \arter\amos\socialauth\Module::t('amossocialauth', 'Collega il tuo profilo') ?>
                            </span>
                        </button>
                    <?php endif; ?>
                </div>
                <div class="floatclear"></div>
            </div>

            <?php if($socialLinked) : ?>
                <div class="media">
                    <div class="media-left">
                        <label>Foto</label>
                        <img src="https://lh4.googleusercontent.com/-97Zgh4BV3rk/AAAAAAAAAAI/AAAAAAAAAaY/N6HnrvhKCio/photo.jpg?sz=200" alt="immagine" width="80px">
                    </div>
                    <div class="media-body">
                        <div class="field-media">
                            <label>Nome</label>
                            <span>Damian</span>
                        </div>
                        <div class="field-media">
                            <label>Cognome</label>
                            <span>Gomez</span>
                        </div>
                        <div class="field-media">
                            <label>Email</label>
                            <span>damian.gomez@arter.it</span>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="validatore_container checkws">
                    <br>
                    <?= \arter\amos\socialauth\Module::t('amossocialauth', 'Nessun profilo collegato.') ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }
    ?>
</div>
