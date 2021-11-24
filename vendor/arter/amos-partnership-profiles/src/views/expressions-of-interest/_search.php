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
 * @package    arter\amos\partnershipprofiles\views\expressions-of-interest
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\partnershipprofiles\Module;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var arter\amos\partnershipprofiles\models\search\ExpressionsOfInterestSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="expressions-of-interest-search element-to-toggle" data-toggle-element="form-search">
    
    <?php
    $form = ActiveForm::begin([
        'action' => Yii::$app->controller->action->id.'?partnership_profile_id='.$_GET['partnership_profile_id'],
        'method' => 'get',
        'options' => [
            'class' => 'default-form'
        ]
    ]);
    ?>

    <div class="col-xs-12">
        <h2 class="title">
            <?= Module::tHtml('amospartnershipprofiles', 'Search by'); ?>:
        </h2>
    </div>

    <div class="col-md-4">
        <?= $form->field($model, 'partnership_offered')->textInput(['placeholder' => Module::t('amospartnershipprofiles', 'Search by partnership offered')]) ?>
    </div>

    <div class="col-md-4">
        <?= $form->field($model, 'additional_information')->textInput(['placeholder' => Module::t('amospartnershipprofiles', 'Search by additional information')]) ?>
    </div>

    <div class="col-md-4">
        <?= $form->field($model, 'clarifications')->textInput(['placeholder' => Module::t('amospartnershipprofiles', 'Search by clarifications')]) ?>
    </div>

    <div class="col-xs-12">
        <div class="pull-right">
            <?= Html::resetButton(Module::tHtml('amospartnershipprofiles', 'Reset'), ['class' => 'btn btn-secondary']) ?>
            <?= Html::submitButton(Module::tHtml('amospartnershipprofiles', 'Search'), ['class' => 'btn btn-navigation-primary']) ?>
        </div>
    </div>

    <div class="clearfix"></div>
    <!--a><p class="text-center">Advanced search<br>
            < ?=AmosIcons::show('caret-down-circle');?>
        </p></a-->
    <?php ActiveForm::end(); ?>
</div>
