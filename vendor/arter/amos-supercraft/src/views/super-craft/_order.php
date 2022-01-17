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

use arter\amos\best\practice\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var arter\amos\best\practice\models\search\ExpressionsOfInterestSearch $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="expressions-of-interest-order element-to-toggle" data-toggle-element="form-order">
    <div class="col-xs-12">
        <h2><?= Module::t('amosbestpractice', 'Order by') ?>:</h2>
    </div>
    
    <?php $form = ActiveForm::begin([
        'action' => Yii::$app->controller->action->id,
        'method' => 'get',
        'options' => [
            'class' => 'default-form'
        ]
    ]);
    echo Html::hiddenInput("currentView", Yii::$app->request->getQueryParam('currentView')); ?>

    <div class="col-sm-6 col-lg-4">
        <?= $form->field($model, 'orderAttribute')->dropDownList($model->getOrderAttributesLabels()) ?>
    </div>
    <div class="col-sm-6 col-lg-4">
        <?= $form->field($model, 'orderType')->dropDownList([
            SORT_ASC => Module::t('amosbestpractice', 'Ascending'),
            SORT_DESC => Module::t('amosbestpractice', 'Descending')
        ]) ?>
    </div>

    <div class="col-xs-12">
        <div class="pull-right">
            <?= Html::a(Module::t('amosbestpractice', 'Cancel'), [
                Yii::$app->controller->action->id, 'currentView' => Yii::$app->request->getQueryParam('currentView')
            ], ['class' => 'btn btn-secondary']) ?>
            <?= Html::submitButton(Module::t('amosbestpractice', 'Order'), ['class' => 'btn btn-navigation-primary']) ?>
        </div>
    </div>

    <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>
</div>
