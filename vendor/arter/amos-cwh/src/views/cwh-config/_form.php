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


use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\CloseSaveButtonWidget;
use arter\amos\cwh\AmosCwh;
use yii\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var arter\amos\cwh\models\CwhConfig $model
 * @var yii\widgets\ActiveForm $form
 */


?>

<div class="cwh-config-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $this->beginBlock('generale'); ?>

    <div class="col-lg-6 col-sm-6">
        <?= $form->field($model, 'classname')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-lg-6 col-sm-6">
        <?= $form->field($model, 'tablename')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-lg-6 col-sm-6">
        <?= $form->field($model, 'visibility')->textarea(['maxlength' => true]) ?>
    </div>
    <div class="col-lg-6 col-sm-6">
        <?= AmosCwh::t('amoscwh', '#visibility_hint') ?>
    </div>

    <div class="clearfix"></div>
    <?php $this->endBlock(); ?>

    <?php $itemsTab[] = [
        'label' => AmosCwh::t('amoscwh', 'generale '),
        'content' => $this->blocks['generale'],
    ];
    ?>

    <?= Tabs::widget(
        [
            'encodeLabels' => false,
            'items' => $itemsTab
        ]
    );
    ?>
    <?= CloseSaveButtonWidget::widget([
            'model' => $model
    ]); ?>
    <?php ActiveForm::end(); ?>
</div>
