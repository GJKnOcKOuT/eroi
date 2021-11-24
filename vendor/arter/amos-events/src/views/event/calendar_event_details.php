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
 * @package    arter\amos\events
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\events\AmosEvents;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var arter\amos\events\models\Event $model
 */

?>

<div class="event-detail-modal">
    <?php
    $attributes = [
        'title',
        'begin_date_hour:datetime',
    ];

    if (!is_null($model->eventType) && $model->eventType->durationRequested) {
        $attributes[] = [
            'label' => $model->getAttributeLabel('length'),
            'value' => $model->length . ' ' . $model->eventLengthMeasurementUnit->title
        ];
    }

    if (!is_null($model->eventType) && $model->eventType->locationRequested) {
        $attributes[] = [
            'label' => AmosEvents::t('amosevents', 'Location'),
            'value' => ($model->country_location_id == 1 ? $model->cityLocation->nome . ' (' . $model->provinceLocation->sigla . '), ' : '') . $model->countryLocation->nome
        ];
    }

    $attributes['eventMembershipType'] = [
        'attribute' => 'eventMembershipType',
        'label' => $model->getAttributeLabel('eventMembershipType'),
        'value' => (!is_null($model->eventMembershipType) ? $model->eventMembershipType->title : '-'),
    ];
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => $attributes
    ]) ?>
    <?php
    if($model->event_type_id == \arter\amos\events\models\EventType::TYPE_OPEN || $model->event_type_id == \arter\amos\events\models\EventType::TYPE_LIMITED_SEATS) {
        echo Html::a(AmosEvents::t('amosevents', '#event_signup_submit'), ['event-signup', 'eid' => $model->id], ['class' => 'btn btn-primary m-l-5 m-b-15 pull-right']);
    }
    ?>
    <?= Html::a(AmosEvents::t('amosevents', 'Open event'), ['view', 'id' => $model->id], ['class' => 'btn btn-primary m-b-15 pull-right']); ?>
</div>
