<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\widgets\graphics\views
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\core\module\BaseAmosModule;

?>

<div class="grid-item">
    <div class="box-widget toolbox-widget">
        <div class="box-widget-toolbar row nom">
            <h2 class="box-widget-title col-xs-10 nop"><?= BaseAmosModule::tHtml('aster', 'Risorse Utili') ?></h2>
        </div>
        <section>
            <div>
                <img src="/img/logo_FIRST.jpg" alt="logo first"/>
                <p><?= Html::a(\Yii::t('aster', 'Cerca un finanziamento'), 'http://first.aster.it/_aster_/bandi', ['title' => 'Cerca un finanziamento', 'target' => '_blank']); ?></p>
            </div>
            <div>
                <span class="dash dash-annuncements"></span>
                <p><?= Html::a(\Yii::t('aster', 'Trova un modello di contratto'), 'https://www.aster.it/accordi-e-contratti-per-la-proprieta-intellettuale', ['target' => '_blank', 'title' => 'Trova un modello di contratto']); ?></p>
            </div>
            <div>
                <img src="/img/logo_A_aster.png" alt="logo eventi"/>
                <p><?= Html::a(\Yii::t('aster', 'Eventi'), 'https://www.aster.it/eventi', ['target' => '_blank', 'title' => 'Eventi']); ?></p>
            </div>
        </section>
    </div>
</div>
