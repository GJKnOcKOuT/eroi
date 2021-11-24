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

/** @var $model \arter\amos\myactivities\basic\OrganizationsToValidate */

?>
<div class="wrap-activity">
    <div class="col-md-1 col-xs-2 icon-plugin">
        <?= AmosIcons::show('building', [], 'dash') ?>
    </div>
    <?= \arter\amos\myactivities\widgets\UserRequestValidation::widget([
        'model' => $model,
        'labelKey' => AmosMyActivities::t('amosmyactivities', 'Validation organizations'),
    ]) ?>
    <div class="col-md-3 col-xs-12 wrap-action">
        <?php
        if ($model->status == $model::ORGANIZATIONS_WORKFLOW_STATUS_TO_VALIDATE) {
            echo Html::a(AmosIcons::show('check') . ' ' . AmosMyActivities::t('amosmyactivities', 'Take charge'),
                Yii::$app->urlManager->createUrl([
                    '/organizations/organizations/in-validation-organization',
                    'id' => $model->id,
                ]),
                ['class' => 'btn btn-secondary']
            );
        } else {
            echo Html::a(AmosIcons::show('check') . ' ' . AmosMyActivities::t('amosmyactivities', 'Validate'),
                Yii::$app->urlManager->createUrl([
                    '/organizations/organizations/validate-organization',
                    'id' => $model->id,
                ]),
                ['class' => 'btn btn-primary']
            );

            echo Html::a(AmosIcons::show('close') . ' ' . AmosMyActivities::t('amosmyactivities', 'Reject'),
                Yii::$app->urlManager->createUrl([
                    '/organizations/organizations/reject-organization',
                    'id' => $model->id,
                ]),
                ['class' => 'btn btn-secondary']
            );
        }
        ?>
    </div>
</div>
<hr>
