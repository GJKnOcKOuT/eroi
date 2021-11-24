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

// TODO HERE

/** @var $model \arter\amos\myactivities\basic\ResultsProposalToValidate */

?>
<div class="wrap-activity">
    <div class="col-md-1 col-xs-2 icon-plugin">
        <?= AmosIcons::show('gears', [], 'dash') ?>
    </div>
    <?= \arter\amos\myactivities\widgets\ExpressionOfInterestToTakeover::widget([
        'model' => $model,
        'labelKey' => $model->is_request_more_info ? AmosMyActivities::t('amosmyactivities', '#eenexpressionofinterestrequestmoreinfo') : AmosMyActivities::t('amosmyactivities', '#eenexpressionofinteresttotakeover'),
    ]) ?>
    <div class="col-md-3 col-xs-12 wrap-action">
        <?php
        echo Html::a(AmosIcons::show('check') . ' ' . AmosMyActivities::t('amosmyactivities', '#takeover'),
            Yii::$app->urlManager->createUrl([
                '/een/een-expr-of-interest/take-over',
                'id' => $model->id,
            ]),
            ['class' => 'btn btn-primary']
        )
        ?>
    </div>
</div>
<hr>
