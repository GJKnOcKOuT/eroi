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
 * @package    arter\amos\slideshow
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\CloseSaveButtonWidget;
use arter\amos\core\forms\CreatedUpdatedWidget;
use arter\amos\core\forms\RequiredFieldsTipWidget;
use arter\amos\core\forms\Tabs;
use arter\amos\core\forms\TextEditorWidget;
use arter\amos\slideshow\AmosSlideshow;

/**
 * @var yii\web\View $this
 * @var arter\amos\slideshow\models\SlideshowPage $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="slideshow-pages-form col-xs-12">

    <?php $form = ActiveForm::begin(); ?>

    <?php $this->beginBlock('generale'); ?>

    <div class="row">
        <div class="col-lg-6 col-sm-6">
            <?= $form->field($model, 'slideshow_id', ['options' => ['style' => 'display:none;']])->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-lg-6 col-sm-6">
            <?= $form->field($model, 'ordinal')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-6">
            <?= $form->field($model, 'pageContent')->widget(TextEditorWidget::className(), [
                'clientOptions' => [
                    'placeholder' => AmosSlideshow::t('amosslideshow', '#page_content_placeholder'),
                    'lang' => substr(Yii::$app->language, 0, 2),
                    'extended_valid_elements' => 'iframe[*]',  
                ]
            ]) ?>
        </div>
    </div>
    <?php $this->endBlock(); ?>

    <?php $itemsTab[] = [
        'label' => AmosSlideshow::tHtml('amosslideshow', 'Generale '),
        'content' => $this->blocks['generale'],
    ];
    ?>

    <?= Tabs::widget([
        'encodeLabels' => false,
        'items' => $itemsTab
    ]); ?>
    <?= RequiredFieldsTipWidget::widget() ?>
    <?= CreatedUpdatedWidget::widget(['model' => $model]) ?>
    <?= CloseSaveButtonWidget::widget(['model' => $model]); ?>
    <?php ActiveForm::end(); ?>
</div>
