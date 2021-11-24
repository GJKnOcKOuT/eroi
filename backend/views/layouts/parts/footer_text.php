<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\views\layouts\parts
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\icons\AmosIcons;
use yii\helpers\Html;

?>
<?php if ((isset(Yii::$app->params['footerText'])) && (Yii::$app->params['footerText'])): ?>
    <div class="footer-space">
        <div class="footer-loghi-aster container-custom">
            <img class="img-responsive" src="/img/Por_Fesr_ER_loghi.jpg">
            <img class="img-responsive" src="/img/logo_art-er.png">
        </div>
        <div class="footer-text-container">
            <div class="footer-text">
                <div class="container">
                    <div class="col-xs-12 col-sm-8">
                        <p><strong>ART-ER S. cons. p. a. – SEDE LEGALE – c/o CNR – Area della Ricerca di Bologna Via Gobetti, 101 – 40129 – Bologna</strong>
                        </p>
                        <p><strong>Tel. +39 051 6398099</strong></p>
                        <p>C.F. e Reg.Imp. di BO 03786281208 - P.IVA 03786281208</p>
                        <p>info@art-er.it | art-er@legalmail.it | www.art-er.it</p>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <p>SEGUICI SUI NOSTRI CANALI SOCIAL</p>
                        <div class="social">
                            <?= Html::a(
                                AmosIcons::show('facebook'),
                                'https://www.facebook.com/arteremiliaromagna',
                                ['title' => 'Seguici su Facebook', 'target' => '_blank']
                            ); ?>
                            <?= Html::a(
                                AmosIcons::show('twitter'),
                                'https://twitter.com/arter_er',
                                ['title' => 'Seguici su Twitter', 'target' => '_blank']
                            ); ?>
                            <?= Html::a(
                                AmosIcons::show('youtube'),
                                'https://www.youtube.com/channel/UCMIPaeplFW9G6DXnSRzEaxQ',
                                ['title' => 'Seguici su YouTube', 'target' => '_blank']
                            ); ?>
                            <?= Html::a(
                                AmosIcons::show('linkedin'),
                                'https://www.linkedin.com/company/art-er/',
                                ['title' => 'Seguici su LinkedIn', 'target' => '_blank']
                            ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php
if (\Yii::$app->getModule('social') && class_exists('\kartik\social\GoogleAnalytics')):
    if (YII_ENV_PROD && !empty(\Yii::$app->getModule('social')->googleAnalytics)):
        echo \kartik\social\GoogleAnalytics::widget([]);
    endif;
endif;
?>
