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
 * @package    arter\amos\events\views\event-wizard
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\ActiveForm;
use arter\amos\events\AmosEvents;
use arter\amos\core\forms\WizardPrevAndContinueButtonWidget;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var ActiveForm $form
 * @var \arter\amos\events\models\Event $model
 */

$moduleCwh = Yii::$app->getModule('cwh');
$moduleTag = Yii::$app->getModule('tag');

$this->title = AmosEvents::t('amosevents',"Nuovo Evento");

?>

<div class="event-wizard-publication">
    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'event-wizard-form',
            'class' => 'form',
            'enableClientValidation' => true,
            'errorSummaryCssClass' => 'error-summary alert alert-error'
        ]
    ]); ?>

    <?php
    $moduleNews = \Yii::$app->getModule(AmosEvents::getModuleName());
    if($moduleNews->hidePubblicationDate == false){?>
    <section>
        <div class="row">
            <div class="col-lg-4 col-sm-4">
                <?= $form->field($model, 'publication_date_begin')->widget(DateControl::className(), [
                    'type' => DateControl::FORMAT_DATE,
                ]); ?>
            </div>
            <div class="col-lg-4 col-sm-4">
                <?= $form->field($model, 'publication_date_end')->widget(DateControl::className(), [
                    'type' => DateControl::FORMAT_DATE,
                ]); ?>
            </div>
        </div>
    </section>
    <?php } ?>
    <section>
        <div class="row">
            <?php if (isset($moduleCwh) && in_array(get_class($model), $moduleCwh->modelsEnabled)): ?>
                <?= \Yii::$app->controller->renderFile('@vendor/arter/amos-cwh/src/views/pubblicazione/cwh.php',
                    [
                        'model' => $model,
                        'form' => $form

                    ]); ?>
            <?php endif; ?>
        </div>
        <div class="row">
            <?php if (isset($moduleTag) && in_array(get_class($model), $moduleTag->modelsEnabled) && $moduleTag->behaviors): ?>
                <?= \arter\amos\tag\widgets\TagWidget::widget([
                    'model' => $model,
                    'attribute' => 'tagValues',
                    'form' => \yii\base\Widget::$stack[0]
                ]); ?>
            <?php endif; ?>
        </div>
    </section>

    <?= WizardPrevAndContinueButtonWidget::widget([
        'model' => $model,
        'previousUrl' => Yii::$app->getUrlManager()->createUrl(['/events/event-wizard/organizational-data', 'id' => $model->id]),
        'continueLabel' => AmosEvents::tHtml('amosevents', 'Finish and save'),
        'continueOptions' => [
            'data-confirm' => AmosEvents::t('amosevents', 'You are finishing the event creation and you cannot go back. Do you want to continue?')
        ],
        'cancelUrl' => Yii::$app->session->get(AmosEvents::beginCreateNewSessionKey())
    ]) ?>
    <?php ActiveForm::end(); ?>
</div>
