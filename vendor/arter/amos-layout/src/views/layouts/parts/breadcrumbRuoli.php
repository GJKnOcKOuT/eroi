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

use yii\widgets\Breadcrumbs;
use arter\amos\core\helpers\Html;

$urlCorrente = yii\helpers\Url::current();
$posizioneEsclusione = strpos($urlCorrente, '?');
$urlParametro = $urlCorrente;
if ($posizioneEsclusione > 0) {
    $urlParametro = preg_quote(substr($urlCorrente, 0, $posizioneEsclusione));
}
$urlFaq = Yii::$app->getUrlManager()->createUrl(['/faq/faq', 'FaqSearch[rotte]' => $urlParametro]);
?>


    <div class="breadcrumb_left">
        <?=
        Breadcrumbs::widget([
            'encodeLabels' => false,
            'homeLink' => [
                'label' => (!empty(\Yii::$app->params['homeName'])? \Yii::$app->params['homeName'] : \Yii::t('amoscore', 'Dashboard')),
                'url' => Yii::$app->homeUrl,
                'encode' => false
            ],
            'links' => [
//                [
//                    'label' => 'Classi Utenti e Ruoli',
//                    'url' => '/classiutenti/classi-utenti'
//                ],
                [
                    'label' => isset($this->params['breadcrumbs']) ? $this->title : '',
                ],               
            ]
        ])
        ?>
    </div>
<!--    <div id="bk-generalTools" class="show breadcrumb-tools">
        <a href="<?php // $urlFaq; ?>"><button>
                <span>FAQ</span><span class="sr-only">Leggi le faq relative al plugin</span>
            </button></a>
    </div>-->


