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
 * @package    @vendor/arter/amos-events/src/views
 * @author     Elite Division S.r.l.
 */
/**
 * @var yii\web\View $this
 * @var arter\amos\events\models\EventCalendars $model
 */


$this->title = \arter\amos\events\AmosEvents::t('amosevents', 'Update calendar');
if($model->event_id){
    $this->title .= ' ' .Yii::t('amosevents', 'for event') .' "'. $event->title.'"';
}
$this->params['breadcrumbs'][] = ['label' => '', 'url' => ['/events']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('amoscore', 'Event Calendars'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => strip_tags($model), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('amoscore', 'Aggiorna');
?>

<div class="event-calendars-update">
    <?= $this->render('_form', [
        'model' => $model,
        'fid' => NULL,
        'dataField' => NULL,
        'dataEntity' => NULL,
        'event' => $event,
        'dataProviderSlots' => $dataProviderSlots,
    ]) ?>

</div>
