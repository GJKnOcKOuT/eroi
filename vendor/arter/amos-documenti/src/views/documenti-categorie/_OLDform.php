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
 * @package    arter\amos\documenti\views\documenti-categorie
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\CloseSaveButtonWidget;
use arter\amos\core\forms\CreatedUpdatedWidget;
use arter\amos\documenti\AmosDocumenti;
use yii\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var arter\amos\documenti\models\DocumentiCategorie $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="documenti-categorie-form col-xs-12">
    <?php
    $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'] // important
    ]);
    
    $customView = Yii::$app->getViewPath() . '/imageField.php';
    ?>
    
    <?php $this->beginBlock('dettagli'); ?>
    <div class="row">
        <div class="col-lg-8 col-sm-8">
            
            <?= $form->field($model, 'titolo')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'sottotitolo')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4 col-sm-4">
            <?= $form->field($model,
                'documentCategoryImage')->widget(\arter\amos\attachments\components\AttachmentsInput::classname(), [
                'options' => [
                    'multiple' => FALSE,
                    'accept' => "image/*",
                ],
                'pluginOptions' => [ // Plugin options of the Kartik's FileInput widget
                    'maxFileCount' => 1,
                    'showRemove' => false,// Client max files,
                    'indicatorNew' => false,
                    'allowedPreviewTypes' => ['image'],
                    'previewFileIconSettings' => false,
                    'overwriteInitial' => false,
                    'layoutTemplates' => false
                ]
            ])->label(AmosDocumenti::t('amosdocumenti', 'Immagine categoria')) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <?= $form->field($model, 'descrizione_breve')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <?= $form->field($model, 'descrizione')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php $this->endBlock('dettagli'); ?>
    
    <?php
    $itemsTab[] = [
        'label' => AmosDocumenti::tHtml('amosdocumenti', 'Dettagli '),
        'content' => $this->blocks['dettagli'],
    ];
    ?>
    
    <?=
    Tabs::widget(
        [
            'encodeLabels' => false,
            'items' => $itemsTab
        ]
    );
    ?>
    <?= CreatedUpdatedWidget::widget(['model' => $model]) ?>
    <?= CloseSaveButtonWidget::widget(['model' => $model]); ?>
    <?php ActiveForm::end(); ?>
</div>
