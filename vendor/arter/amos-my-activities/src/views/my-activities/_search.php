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

use arter\amos\core\forms\ActiveForm;
use arter\amos\core\helpers\Html;
use arter\amos\myactivities\AmosMyActivities;

/**
 * @var \arter\amos\myactivities\models\search\MyActivitiesModelSearch $modelSearch
 */

?>

<div class="myactivities-search element-to-toggle" data-toggle-element="form-search">
    <div class="col-xs-12"><h2><?= AmosMyActivities::t('amosmyactivities', 'Search for') ?>:</h2></div>

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="col-xs-12">
        <?= $form->field($modelSearch, 'searchString') ?>
    </div>

    <div class="col-xs-12">
        <div class="pull-right">
            <?= Html::submitButton(AmosMyActivities::t('amosmyactivities', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::a(AmosMyActivities::t('amosmyactivities', 'Reset'), [Yii::$app->controller->action->id], ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    <div class="clearfix"></div>

</div>
