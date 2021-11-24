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
 * @package    arter\amos\een\views\een-partnership-proposal
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
use arter\amos\core\views\DataProviderView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var \arter\amos\een\models\EenPartnershipProposal $model
 * @var string $currentView
 */
$currentUrl = explode("?", \yii\helpers\Url::current());
$isArchived = false;
if ($currentUrl[0] == '/een/een-partnership-proposal/archived') {
    $isArchived = true;
}

$this->params['textHelp']['filename'] = 'description';
$moduleEen                            = \Yii::$app->getModule(arter\amos\een\AmosEen::getModuleName());
$profile                              = \arter\amos\admin\models\UserProfile::find()->andWhere(['user_id' => \Yii::$app->user->id])->one();
if ($moduleEen->enableCreateEen && $profile && $profile->validato_almeno_una_volta) {
    echo \yii\helpers\Html::a(\arter\amos\een\AmosEen::t('amoseen', "Crea una proposta"), 'create-proposal',
        ['class' => 'btn btn-navigation-primary']);
} else {
    echo \yii\helpers\Html::a(\arter\amos\een\AmosEen::t('amoseen', "Crea una proposta"), 'javascript:void(0)',
        [
        'class' => 'btn btn-navigation-primary',
        'data-target' => "#modal-een-alert",
        'data-toggle' => "modal"
    ]);
    \yii\bootstrap\Modal::begin([
        'id' => 'modal-een-alert'
    ]);
    echo "<p>".\arter\amos\een\AmosEen::t('amoseen',
        'Per pubblicare la tua proposta di collaborazione tecnologica nel database della rete Enterprise Europe Network (EEN) è possibile contattare <a href="https://een.ec.europa.eu/about/branches/italy" title="vai alla lista degli enti di riferimento" target="_blank">uno degli enti di riferimento della Rete EEN per la tua regione</a>.<br><br>
Se sei localizzato in Emilia-Romagna e sei interessato a pubblicare la tua proposta di collaborazione tecnologica nel database EEN, puoi contattare direttamente lo Staff EEN in ART-ER all’indirizzo e-mail: <a href="mailto: simpler@art-er.it">simpler@art-er.it</a>')."</p>";
    \yii\bootstrap\Modal::end();
}
?>
<div class="proposte-collaborazione-een-index">
    <?= $this->render('_search', ['model' => $model, 'countryTypes' => $countryTypes]); ?>
    <?=
    DataProviderView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $model,
        'currentView' => $currentView,
        'gridView' => [
            'columns' => [
                'content_title',
                'reference_external',
                'reference_type',
                /*
                  'tipologiaProposteEen' => [
                  'attribute' => 'tipologiaProposteEen',
                  'format' => 'html',
                  'label' => $model->getAttributeLabel('tipologiaProposteEen'),
                  'value' => function ($model) {
                  return strip_tags($model->getAttrTipologiaProposteEenMm());
                  }
                  ],
                 */
                //'paese',
                'datum_submit:date',
                'datum_deadline:date',
                [
                    'class' => 'arter\amos\core\views\grid\ActionColumn',
                    'template' => '{view}{expr_of_interest}',
                    'buttons' => [
                        'expr_of_interest' => function($url, $model)use($isArchived) {
                            if (!$model->isExprOfInterestSended() && !$isArchived) {
                                return \arter\amos\core\helpers\Html::a(\arter\amos\core\icons\AmosIcons::show('thumb-up'),
                                        "#interestPopup-{$model->id}",
                                        [
                                        'class' => ['btn btn-tools-secondary'],
                                        'title' => \arter\amos\een\AmosEen::t('amoseen',
                                            '#expr_of_interest_verb'),
                                        'data-target' => "#interestPopup-{$model->id}",
                                        'data-toggle' => "modal",
                                    ]).$this->render('_modal_expr_of_interest', ['model' => $model]);
                            } else return '';
                        }
                    ]
                ],
            ],
        ],
        'listView' => [
            'itemView' => '_item',
            'masonry' => FALSE,
        // Se masonry settato a TRUE decommentare e settare i parametri seguenti
        // nel CSS settare i seguenti parametri necessari al funzionamento tipo
        // .grid-sizer, .grid-item {width: 50&;}
        // Per i dettagli recarsi sul sito http://masonry.desandro.com
        //'masonrySelector' => '.grid',
        //'masonryOptions' => [
        //    'itemSelector' => '.grid-item',
        //    'columnWidth' => '.grid-sizer',
        //    'percentPosition' => 'true',
        //    'gutter' => '20'
        //]
        ],
    ]);
    ?>
</div>
