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
 * @package    arter\amos\documenti\views\documenti-wizard
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\WizardPrevAndContinueButtonWidget;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\documenti\AmosDocumenti;

/**
 * @var yii\web\View $this
 * @var arter\amos\documenti\models\Documenti $model
 * @var yii\widgets\ActiveForm $form
 */

$this->title = AmosDocumenti::t('amosdocumenti', '#documents_wizard_page_title');
?>

<div class="document-wizard-introduction col-xs-12 nop">
    <div class="col-lg-12 nop">
        <div class="pull-left">
            <!-- ?= AmosIcons::show('file-text-o', ['class' => 'am-4 icon-calendar-intro m-r-15'], 'dash') ?-->
            <div class="like-widget-img color-primary ">
                <?= AmosIcons::show('file-text-o', [], 'dash'); ?>
            </div>
        </div>
        <div class="text-wrapper">
            <?= AmosDocumenti::t('amosdocumenti', '#WIZARD_INTRO_1') ?>
            <div class="nop col-xs-12">
                <p><?= AmosDocumenti::t('amosdocumenti', '#WIZARD_INTRO_2') ?>:</p>
                <div>
                    <ol>
                        <li>
                            <?= AmosDocumenti::tHtml('amosdocumenti', "#WIZARD_INTRO_3") ?>
                        </li>
                        <li>
                            <?= AmosDocumenti::tHtml('amosdocumenti', "#WIZARD_INTRO_4") ?>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 nop">
        <p>
            <strong><?= AmosDocumenti::t('amosdocumenti', '#WIZARD_INTRO_5') ?></strong>
        </p>
    </div>
    
    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'document-wizard-form',
            'class' => 'form',
            'enableClientValidation' => true,
            'errorSummaryCssClass' => 'error-summary alert alert-error'
        ]
    ]); ?>
    <br>
    <br>
    <div class="nop col-xs-12 text-uppercase m-t-15 m-b-25">
        <strong><?= Html::a(AmosDocumenti::tHtml('amosdocumenti', '#SKIP_WIZARD'), ['/documenti/documenti/create', 'parentId' => $model->parent_id]) ?></strong>
    </div>
    <br>
    <?= WizardPrevAndContinueButtonWidget::widget([
        'model' => $model,
        'viewPreviousBtn' => false,
        'cancelUrl' => Yii::$app->session->get(AmosDocumenti::beginCreateNewSessionKey())
    ]) ?>
    <?php ActiveForm::end(); ?>
</div>
