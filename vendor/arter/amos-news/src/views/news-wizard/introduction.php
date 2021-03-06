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
 * @package    arter\amos\news\views\news-wizard
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\WizardPrevAndContinueButtonWidget;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\news\AmosNews;

/**
 * @var yii\web\View $this
 * @var arter\amos\news\models\News $model
 * @var yii\widgets\ActiveForm $form
 */

$this->title = AmosNews::t('amosnews', '#news_wizard_page_title');

?>

<div class="news-wizard-introduction col-xs-12 nop">
    <div class="col-lg-12 nop">
        <div class="pull-left">
            <!-- ?= AmosIcons::show('feed', ['class' => 'am-4 icon-calendar-intro m-r-15'], 'dash') ?-->
            <div class="like-widget-img color-primary ">
                <?= AmosIcons::show('feed', [], 'dash'); ?>
            </div>
        </div>
        <div class="text-wrapper">
            <?= AmosNews::t('amosnews', 'Pubblica notizie con gli utenti della piattaforma o con gruppi specifici di utenti. Gli utenti possono partecipare inserendo commenti o rispondendo a quelli inseriti da altri.') ?>
            <div class="nop col-xs-12">
                <p><?= AmosNews::t('amosnews', '#wizard_introduction_insert_information') ?>:</p>
                <div>
                    <ol>
                        <li>
                            <?= AmosNews::tHtml('amosnews', "informazioni che descrivono la notizia (titolo, sottotitolo, abstract, testo)") ?>
                        </li>
                        <li>
                            <?= AmosNews::tHtml('amosnews', "informazioni per la pubblicazione e la visibilit√†") ?>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 nop">
        <p>
            <strong><?= AmosNews::t('amosnews', '#wizard_introduction_press_continue') ?></strong>
        </p>
    </div>
    
    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'news-wizard-form',
            'class' => 'form',
            'enableClientValidation' => true,
            'errorSummaryCssClass' => 'error-summary alert alert-error'
        ]
    ]); ?>
    <br>
    <br>
    <div class="nop col-xs-12 m-t-15 m-b-25">
        <strong><?= Html::a(AmosNews::tHtml('amosnews', 'Skip wizard. Fill directly the news.'), ['/news/news/create']) ?></strong>
    </div>
    <br>
    
    <?= WizardPrevAndContinueButtonWidget::widget([
        'model' => $model,
        'viewPreviousBtn' => false,
        'cancelUrl' => Yii::$app->session->get(AmosNews::beginCreateNewSessionKey())
    ]) ?>
    <?php ActiveForm::end(); ?>
</div>
