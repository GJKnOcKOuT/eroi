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
use arter\amos\core\widget\WidgetAbstract;

/* $urlCorrente = yii\helpers\Url::current();
  $posizioneEsclusione = strpos($urlCorrente, '?');
  $urlParametro = $urlCorrente;
  if ($posizioneEsclusione > 0) {
  $urlParametro = preg_quote(substr($urlCorrente, 0, $posizioneEsclusione));
  }
  $urlFaq = Yii::$app->getUrlManager()->createUrl(['/faq/faq', 'FaqSearch[rotte]' => $urlParametro]); */
?>
<?php
if (!empty($this->params['breadcrumbs'])):

    if (!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
        $homeLink = \arter\amos\core\icons\AmosIcons::show('dashboard', [],
                \arter\amos\core\icons\AmosIcons::DASH);
    } else {
        $homeLink = \Yii::t('amoscore', 'Dashboard');
    }


    foreach ((array) $this->params['breadcrumbs'] as $key => $value) {
        if (!isset($value['title']) && !empty($value['label'])) {
            $this->params['breadcrumbs'][$key]['title'] = html_entity_decode($this->params['breadcrumbs'][$key]['label']);
        }
    }
    ?>
    <?php
    $session = Yii::$app->session;
    if (!empty(\Yii::$app->params['isPoi']) && \Yii::$app->params['isPoi'] == true && isset($session["cwh-scope"]) && !empty($session['cwh-scope']['community'])
        && $session['cwh-scope']['community'] == 2750
    ) {
        ?>
        <?=
        Breadcrumbs::widget([
            'encodeLabels' => false,
            'homeLink' => [
                'label' => '',
                'url' => '',
                'encode' => false,
                'title' => ''
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ])
        ?>
    <?php } else { ?>
        <?=
        Breadcrumbs::widget([
            'encodeLabels' => false,
            'homeLink' => [
                'label' => (!empty(\Yii::$app->params['homeName']) ? \Yii::$app->params['homeName'] : $homeLink),
                'url' => Yii::$app->homeUrl,
                'encode' => false,
                'title' => 'home'
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ])
        ?>
    <?php } ?>
<?php endif; ?>
<!--div id="bk-generalTools" class="show breadcrumb-tools">
    <a href="<?php //echo $urlFaq;     ?>"><button>
        <span>FAQ</span><span class="sr-only">Leggi le faq relative al plugin</span>
        </button></a>
</div-->