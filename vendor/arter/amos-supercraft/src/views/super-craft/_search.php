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


use arter\amos\best\practice\Module;
use arter\amos\best\practice\utility\BestPracticeUtility;
use arter\amos\core\forms\editors\Select;
use arter\amos\core\helpers\Html;
use kartik\datecontrol\DateControl;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var arter\amos\best\practice\models\search\BestPracticeSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="best-practice-search element-to-toggle" data-toggle-element="form-search">
    <div class="col-xs-12"><h2>Cerca per:</h2></div>

    <?php $form = ActiveForm::begin([
        'action' => Yii::$app->controller->action->id,
        'method' => 'get',
        'options' => [
            'class' => 'default-form'
        ]
    ]);

    echo Html::hiddenInput("enableSearch", "1");
    echo Html::hiddenInput("currentView", Yii::$app->request->getQueryParam('currentView'));
    ?>

    <div class="col-md-4">
        <?= $form->field($model, 'title')->textInput() ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'created_at_from')->widget(DateControl::classname(), [
            'type' => DateControl::FORMAT_DATE
        ]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'created_at_to')->widget(DateControl::classname(), [
            'type' => DateControl::FORMAT_DATE
        ]) ?>
    </div>
    <?php if (\Yii::$app->controller->id == 'best-practice' && \Yii::$app->controller->action->id != 'created-by'): ?>
        <div class="col-md-4">
            <?= $form->field($model, 'created_by')->widget(Select::className(), [
                'options' => [
                    'placeholder' => Module::t('amoscore', 'Select/Choose'),
                    'disabled' => false
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
                'data' => BestPracticeUtility::getCreatedByUsersReadyForSelect()
            ]) ?>
        </div>
    <?php endif; ?>

    <div class="col-xs-12">
        <div class="pull-right">
            <?= Html::resetButton(Yii::t('amosbestpractice', 'Reset'), ['class' => 'btn btn-secondary']) ?>
            <?= Html::submitButton(Yii::t('amosbestpractice', 'Search'), ['class' => 'btn btn-navigation-primary']) ?>
        </div>
    </div>

    <div class="clearfix"></div>
    <!--a><p class="text-center">Ricerca avanzata<br>
                < ?=AmosIcons::show('caret-down-circle');?>
            </p></a-->
    <?php ActiveForm::end(); ?>

</div>
