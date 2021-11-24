<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\widgets\graphics\views\fullsize
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\module\BaseAmosModule;

?>
<div class="box-widget-header">
    <div class="box-widget-wrapper">
        <h2 class="box-widget-title">
            <?= AmosIcons::show('community', ['class' => 'am-2'], AmosIcons::IC) ?>
            <span class="pluginName"><?= BaseAmosModule::tHtml('aster', 'Risorse Utili') ?></span>
        </h2>
    </div>
</div>
<div class="box-widget box-widget-column toolbox">
    <section>
        <div class="list-items">
            
            <div class="widget-listbox-option" role="option">
                <article class="wrap-item-box">
                    <div class="container-img">
                        <img src="/img/logo_Mentor_EROI.jpg" alt="logo Mentor EROI"/>
                    </div>
                    <div class="container-text">
                        <h2 class="box-widget-subtitle"><?= Html::a(\Yii::t('asterplatform', '#contact_Mentor_EROI'), '/admin/user-profile/facilitator-users', ['title' => \Yii::t('asterplatform', '#contact_Mentor_EROI'), 'target' => '_blank']); ?></h2>
                    </div>
                </article>
            </div>
            <div class="widget-listbox-option" role="option">
                <article class="wrap-item-box">
                    <div class="container-img">
                        <img src="/img/logo_FIRST.jpg" alt="logo first"/>
                    </div>
                    <div class="container-text">
                        <h2 class="box-widget-subtitle"><?= Html::a(\Yii::t('aster', 'Cerca un finanziamento'), 'http://first.aster.it/_aster_/bandi', ['title' => 'Cerca un finanziamento', 'target' => '_blank']); ?></h2>
                    </div>
                </article>
            </div>
            <div class="widget-listbox-option" role="option">
                <article class="wrap-item-box">
                    <div class="container-img">
                        <?= AmosIcons::show('annuncements', ['class' => 'am-2'], AmosIcons::DASH) ?>
                    </div>
                    <div class="container-text">
                        <h2 class="box-widget-subtitle"><?= Html::a(\Yii::t('aster', 'Trova un modello di contratto'), 'https://www.aster.it/accordi-e-contratti-per-la-proprieta-intellettuale', ['target' => '_blank', 'title' => 'Trova un modello di contratto']); ?></h2>
                    </div>
                </article>
            </div>
<!--            <div class="widget-listbox-option" role="option">-->
<!--                <article class="wrap-item-box">-->
<!--                    <div class="container-img">-->
<!--                        <img src="/img/logo_A_aster.png" alt="logo eventi"/>-->
<!--                    </div>-->
<!--                    <div class="container-text">-->
<!--                        <h2 class="box-widget-subtitle">< ?= Html::a(\Yii::t('aster', 'Eventi'), 'https://www.aster.it/eventi', ['target' => '_blank', 'title' => 'Eventi']); ?></h2>-->
<!--                    </div>-->
<!--                </article>-->
<!--            </div>-->
        </div>
    </section>
</div>
