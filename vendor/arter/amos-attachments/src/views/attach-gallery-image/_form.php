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
 * @package    @vendor/arter/amos-attachments/src/views
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\core\forms\ActiveForm;
use kartik\datecontrol\DateControl;
use arter\amos\core\forms\Tabs;
use arter\amos\core\forms\CloseSaveButtonWidget;
use arter\amos\core\forms\RequiredFieldsTipWidget;
use yii\helpers\Url;
use arter\amos\core\forms\editors\Select;
use yii\helpers\ArrayHelper;
use arter\amos\core\icons\AmosIcons;
use yii\bootstrap\Modal;
use yii\redactor\widgets\Redactor;
use yii\helpers\Inflector;
use arter\amos\attachments\FileModule;

/**
 * @var yii\web\View $this
 * @var arter\amos\attachments\models\AttachGalleryImage $model
 * @var yii\widgets\ActiveForm $form
 */


?>
<div class="attach-gallery-image-form col-xs-12 nop">

    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'attach-gallery-image_' . ((isset($fid)) ? $fid : 0),
            'data-fid' => (isset($fid)) ? $fid : 0,
            'data-field' => ((isset($dataField)) ? $dataField : ''),
            'data-entity' => ((isset($dataEntity)) ? $dataEntity : ''),
            'class' => ((isset($class)) ? $class : ''),
            'enctype' => 'multipart/form-data'
        ]
    ]);
    ?>
    <?php // $form->errorSummary($model, ['class' => 'alert-danger alert fade in']); ?>

    <div class="row">
        <div class="col-xs-12"><h2 class="subtitle-form"><?= FileModule::t('amosattachments' ,'#settings')?></h2>
            <div class="col-md-8 col xs-12"><!-- name string -->
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?><!-- description text -->
                <div class="col-md-6 col xs-12">
                    <?php
                    if (\Yii::$app->getUser()->can('ATTACHGALLERY_CREATE')) {
                        $append = ' canInsert';
                    } else {
                        $append = NULL;
                    }
                    ?>
                <?= $form->field($model, 'gallery_id')->widget(Select::classname(), [
                    'data' => ArrayHelper::map(\arter\amos\attachments\models\AttachGallery::find()->asArray()->all(), 'id', 'name'),
                    'language' => substr(Yii::$app->language, 0, 2),
                    'options' => [
                        'id' => 'AttachGallery' . $fid,
                        'multiple' => false,
//                            'placeholder' => 'Seleziona ...',
//                            'class' => 'dynamicCreation' . $append,
//                            'data-model' => 'attach_gallery',
//                            'data-field' => 'name',
//                            'data-module' => 'attachments',
//                            'data-entity' => 'attach-gallery',
//                            'data-toggle' => 'tooltip'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
//                        'pluginEvents' => [
//                            "select2:open" => "dynamicInsertOpening"
//                        ]
                ])
                ?>
                </div>
                <div class="col-md-6 col xs-12">
                    <?php
                    if (\Yii::$app->getUser()->can('ATTACHGALLERYCATEGORY_CREATE')) {
                        $append = ' canInsert';
                    } else {
                        $append = NULL;
                    }
                    ?>
                <?= $form->field($model, 'category_id')->widget(Select::classname(), [
                    'data' => ArrayHelper::map(\arter\amos\attachments\models\AttachGalleryCategory::find()->asArray()->all(),'id','name'),
                    'language' => substr(Yii::$app->language, 0, 2),
                    'options' => [
                        'id' => 'AttachGalleryCategory' . $fid,
                        'multiple' => false,
                        'placeholder' => 'Seleziona ...',
                        'class' => 'dynamicCreation' . $append,
                        'data-model' => 'attach_gallery_category',
                        'data-field' => 'name',
                        'data-module' => 'attachments',
                        'data-entity' => 'attach-gallery-category',
                        'data-toggle' => 'tooltip'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                    'pluginEvents' => [
                        "select2:open" => "dynamicInsertOpening"
                    ]
                ]);
                ?>
                </div>
                <?= $form->field($model, 'description')->widget(yii\redactor\widgets\Redactor::className(), [
                    'options' => [
                        'id' => 'description' . $fid,
                    ],
                    'clientOptions' => [
                        'language' => substr(Yii::$app->language, 0, 2),
                        'plugins' => ['clips', 'fontcolor', 'imagemanager'],
                        'buttons' => ['format', 'bold', 'italic', 'deleted', 'lists', 'image', 'file', 'link', 'horizontalrule'],
                    ],
                ]);
                ?>


            </div>
            <div class="col-md-4 col xs-12">
                <div class="col-xs-12 nop">
                    <?=
                    $form->field($model, 'attachImage')->widget(\arter\amos\attachments\components\CropInput::classname(),
                        [
                            'enableUploadFromGallery' => false,
                            'jcropOptions' => ['aspectRatio' => '1.7']
                        ])->label(FileModule::t('amosattachments', '#image_field'))
                    ?>
                </div>

            </div>
        </div>
        <div class="clearfix"></div>

    </div>

    <div class="col-md-12 col xs-12">
        <?= RequiredFieldsTipWidget::widget(); ?>

        <?= CloseSaveButtonWidget::widget(['model' => $model]); ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
