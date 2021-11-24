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
* @var arter\amos\events\models\EventCalendarsSlots $model
*/

$this->title = Yii::t('amoscore', 'Crea', [
    'modelClass' => 'Event Calendars Slots',
]);
$this->params['breadcrumbs'][] = ['label' => '', 'url' => ['/events']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('amoscore', 'Event Calendars Slots'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-calendars-slots-create">
    <?= $this->render('_form', [
    'model' => $model,
    'fid' => NULL,
    'dataField' => NULL,
    'dataEntity' => NULL,
    ]) ?>

</div>
