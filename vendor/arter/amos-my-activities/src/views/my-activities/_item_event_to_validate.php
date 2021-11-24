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
 * @package    arter\amos\myactivities\views\my-activities
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\myactivities\AmosMyActivities;
use yii\web\View;

/** @var $model \arter\amos\myactivities\basic\EventToValidate */

$js = "
$('.events-reject-btns').on('click', function(event) {
    event.preventDefault();
    var hrefValue = $(this).attr('href');
    var visibleInCalendar = confirm(\"" . AmosMyActivities::t('amosmyactivities', "Is the event still to be visible in the calendar even during the edit") . "?\");
    this.href = hrefValue + '&visibleInCalendar=' + (visibleInCalendar ? 1 : 0);
    window.location.href = this.href;
});
";
$this->registerJs($js, View::POS_READY);

?>
<div class="wrap-activity">
    <div class="col-md-1 col-xs-2 icon-plugin">
        <?= AmosIcons::show('calendar', [], 'dash') ?>
    </div>
    <?= \arter\amos\myactivities\widgets\UserRequestValidation::widget([
        'model' => $model,
        'labelKey' => AmosMyActivities::t('amosmyactivities', 'Validation event'),
    ]) ?>
    <div class="col-md-3 col-xs-12 wrap-action">
        <?php
        echo Html::a(AmosIcons::show('check') . ' ' . AmosMyActivities::t('amosmyactivities', 'Validate'),
            Yii::$app->urlManager->createUrl([
                '/events/event/validate',
                'id' => $model->id,
            ]),
            ['class' => 'btn btn-primary']
        )
        ?>
        <?php
        echo Html::a(AmosIcons::show('close') . ' ' . AmosMyActivities::t('amosmyactivities', 'Reject'),
            Yii::$app->urlManager->createUrl([
                '/events/event/reject',
                'id' => $model->id,
            ]),
            ['class' => 'btn btn-secondary events-reject-btns']
        )
        ?>
    </div>
</div>
<hr>
