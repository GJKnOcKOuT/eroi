<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/** @var $modelForm \arter\amos\events\models\FormAssignSeat
 * @var $model \arter\amos\events\models\Event
 */

use arter\amos\events\AmosEvents;

if(!empty($eventCompanion)){
    $this->title = AmosEvents::t('amosevents', 'Assegna posto ad utente') . ' ' . $eventCompanion->nome. ' '.$eventCompanion->cognome;
}else {
    $this->title = AmosEvents::t('amosevents', 'Assegna posto ad utente') . ' ' . $user->userProfile->nomeCognome;
}

$form = \arter\amos\core\forms\ActiveForm::begin(); ?>
    <h3><?= AmosEvents::t('amosevents', 'Totale posti da assegnare:') . ' ' . $n_seats_to_assign ?></h3>
    <div class="col-xs-3">
        <?php echo $form->field($modelForm, 'sector')->widget(\kartik\select2\Select2::className(), [
            'data' => \yii\helpers\ArrayHelper::map($model->getSectors(), 'sector', 'sector'),
            'options' => [
                'id' => 'sector_id',
                'placeholder' => AmosEvents::t('amosevents', 'Select...')]
        ])->label(AmosEvents::t('amosevents', 'Settore'));
        ?>
    </div>
    <div class="col-xs-3">
        <?php echo \yii\helpers\Html::hiddenInput('event_id', $model->id, ['id' => 'event_id']) ?>
        <?php echo $form->field($modelForm, 'row')->widget(\kartik\depdrop\DepDrop::className(), [
            'options' => ['id' => 'row_id'],
            'pluginOptions' => [
                'depends' => ['sector_id'],
                'placeholder' => 'Select...',
                'url' => \yii\helpers\Url::to(['get-rows-ajax']),
                'params' => ['event_id']

            ]
        ])->label(AmosEvents::t('amosevents', 'Fila'));
        ?>
    </div>
    <div class="col-xs-3">
        <?php echo $form->field($modelForm, 'seat')->widget(\kartik\depdrop\DepDrop::className(), [
            'options' => ['id' => 'seat_id'],
            'pluginOptions' => [
                'depends' => ['row_id'],
                'placeholder' => 'Select...',
                'url' => \yii\helpers\Url::to(['get-seats-ajax']),
                'params' => ['event_id', 'sector_id']
            ]
        ])->label(AmosEvents::t('amosevents', 'Posto'));
        ?>
    </div>
    <div class="col-xs-12">
        <?= \arter\amos\core\forms\CloseSaveButtonWidget::widget([
            'model' => $model
        ]) ?>
    </div>

<?php
\arter\amos\core\forms\ActiveForm::end();
?>