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
 * @package    arter\amos\faq
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\CloseSaveButtonWidget;
use arter\amos\core\forms\CreatedUpdatedWidget;
use arter\amos\faq\AmosFaq;
use yii\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var arter\amos\faq\models\FaqStato $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="faq-stato-form">
    
    <?php $form = ActiveForm::begin(); ?>
    
    <?php $this->beginBlock('generale'); ?>

    <div class="col-lg-6 col-sm-6 nopl">
        
        <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-lg-6 col-sm-6 nopr">
        
        <?= $form->field($model, 'descrizione')->textarea(['rows' => 6]) ?>
    </div>
    <div class="clearfix"></div>
    <?php $this->endBlock('generale'); ?>
    
    <?php $itemsTab[] = [
        'label' => AmosFaq::tHtml('amosfaq', 'Generale '),
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
    <div class="col-xs-12 note_asterisk nop">
        <p>I campi <span class="red">*</span> sono obbligatori.</p>
    </div>
    <?= CreatedUpdatedWidget::widget(['model' => $model]) ?>
    <?= CloseSaveButtonWidget::widget(['model' => $model]); ?>
    <?php ActiveForm::end(); ?>
</div>
