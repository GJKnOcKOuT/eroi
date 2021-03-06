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
 * @package    arter\amos\attachments
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 *
 * @var \yii\web\View $this
 * @var \arter\amos\attachments\components\CropInput $crop
 * @var string $inputField
 */
use yii\bootstrap\Modal;
use yii\helpers\Html; 
use yii\helpers\Json;
use arter\amos\attachments\FileModule;
use arter\amos\attachments\assets\ModuleAttachmentsAsset;
use uitrick\yii2\widget\upload\crop\UploadCropAsset;
use arter\amos\core\icons\AmosIcons;

$inputId    = Html::getInputId($crop->model, $crop->attribute);
$moduleName = FileModule::getModuleName();


if (!empty(\Yii::$app->params['bsVersion']) && \Yii::$app->params['bsVersion'] == '4.x') {
    $spriteAsset = arter\amos\layout\assets\BootstrapItaliaCustomSpriteAsset::register($this);
} else {
    \arter\amos\attachments\assets\ModuleAttachmentsAsset::register($this);
}


$js2 = <<<JS

$(window).on('shown.bs.modal', function() { 
    $('.cropper-alert button').attr('data-dismiss', 'modal');
});

JS;
$this->registerJs($js2, \yii\web\View::POS_READY);

$js = <<<JS
//On delete button click
jQuery('.deleteImageCrop', '#cropInput_{$crop->attribute}').on('click', function() {
    //Metadata
    var data = jQuery(this).data();
    
    //Hide the button
    jQuery(this).addClass('hidden');
    
    //Remove the image
    jQuery('.preview-container img', '#cropInput_{$crop->attribute}').remove();
    
    //Clear crop if exists
    jQuery('.cropper-data', '#cropInput_{$crop->attribute}').attr('val', '');
    
    jQuery.get('/{$moduleName}/file/delete',{
        'id': data.id,
        'item_id': data.item_id,
        'model': data.model,
        'attribute': data.attribute
    }, function(result) {
        //TODO
    }, 'json');
});

jQuery('.modal-body .tools>.rotate_{$crop->attribute}', '#cropInput_{$crop->attribute}').on('click', function() {
    var data = jQuery(this).data();
    $('.modal-body .cropper-wrapper>img', '#cropInput_{$crop->attribute}').cropper(data.type, data.option);
});

//On new image selected
jQuery('.modal-footer button[class*="cropper-done"]', '#cropInput_{$crop->attribute}').on('click', function() {
    jQuery('.deleteImageCrop', '#cropInput_{$crop->attribute}').removeClass('hidden');
});
JS;

$this->registerJs($js, \yii\web\View::POS_READY);

if ($crop->isFrontend == false) {
    ModuleAttachmentsAsset::register($this);
}

$attachament      = $crop->model->{$crop->attribute};

$alertString = FileModule::t('amosattachment', "Estensione file non permessa, inserire un file con un'estensione consentita.");
$css = <<<CSS
.cropper-alert + .cropper-body {
    display: none;
}
 .cropper-alert{
        font-size: 0px;
    }
    .cropper-alert::after{
        content: "$alertString";
        font-size:15px;
        margin-left: 60px;
}
CSS;

$this->registerCss($css);
?>

<div class="uploadcrop attachment-uploadcrop" id="cropInput_<?= $crop->attribute; ?>">
<?= FileModule::t('amosattachments', '#attach_label_title') ?>
    <?php if( $aspectRatio == '1.7' && $customHint): ?>
       <?php 
        $ratioTooltipText=FileModule::t('amosattachments', '#default_message');
        $ratioTooltip=" <button type='button' data-toggle='tooltip' style='border:0; background:transparent' data-placement='top' title=' $ratioTooltipText'>
                            <span class='am am-info'></span>
                        </button>";?>
        
            <?= 
                $crop->form->field($crop->model, $crop->attribute)
                        ->fileInput($crop->options)
                        ->label(FileModule::t('amosattachments', '#attach_label'), 
                        ['title' => FileModule::t('amosattachments', '#attach_label_title')])
                        ->hint($customHint.$ratioTooltip); 
            ?>
       

    <?php else: ?>

        <?= 
            $crop->form->field($crop->model, $crop->attribute)
                    ->fileInput($crop->options)
                    ->label(FileModule::t('amosattachments', '#attach_label'), 
                    ['title' => FileModule::t('amosattachments', '#attach_label_title')]);
        ?>

    <?php endif; ?>


    <!-- < ?= $crop->form->field($crop->model, $crop->attribute)->fileInput($crop->options)->label(FileModule::t('amosattachments',
            '#attach_label'), ['title' => FileModule::t('amosattachments', '#attach_label_title')]);
    ?> -->
<?= Html::hiddenInput($crop->attribute.'_data', '', ['class' => 'cropper-data']); ?>

    <div class="preview-pane <?= (!is_null($crop->defaultPreviewImage)) ? 'image-find' : '' ?>">
        <?php
        $closeButtonClass = is_null($crop->defaultPreviewImage) ? ' hidden' : '';
        echo Html::a(AmosIcons::show('close', ['class' => 'btn btn-icon']), 'javascript:void(0)',
            [
            'class' => 'deleteImageCrop '.$closeButtonClass,
            'title' => FileModule::t('amosattachments', '#attach_delete_image_crop'),
            'data' => [
                'id' => $attachament ? $attachament->id : null,
                'item_id' => $crop->model->id,
                'model' => get_class($crop->model),
                'attribute' => $crop->attribute
            ]
        ]);
        ?>
        <div class="preview-container">
            <?php
            if (!is_null($crop->defaultPreviewImage)) {
                $defaultPreviewImageOptions = [
                    'id' => Yii::$app->getSecurity()->generateRandomString(10),
                    'class' => 'preview_image'
                ];
                echo Html::img($crop->defaultPreviewImage, $defaultPreviewImageOptions);
            }
            ?>
        </div>
    </div>

    <?php if (!empty(\Yii::$app->params['bsVersion']) && \Yii::$app->params['bsVersion'] == '4.x') : ?>

        <?php yii\bootstrap4\Modal::begin([
              'id' => 'modal-image-crop cropper-modal-' . $crop->imageOptions['id'],
              'title' => '<h2>' . FileModule::t('amosattachments', '#crop_title') . '</h2>',
              'closeButton' => [],
              'footer' => '<div class="cropper-btns">'
                  . Html::button(FileModule::t('amosattachments', '#cancel_btn'), ['id' => $crop->imageOptions['id'] . '_button_cancel', 'class' => 'btn btn-link mr-3', 'data-dismiss' => 'modal'])
                  . Html::button(FileModule::t('amosattachments', '#accept_btn'), ['id' => $crop->imageOptions['id'] . '_button_accept', 'class' => 'btn btn-primary cropper-done']) . '</div>',
              'size' => yii\bootstrap4\Modal::SIZE_LARGE,
              'clientOptions' => ['backdrop' => 'static'] //To prevent closing when you drag outside the modal window
          ]); ?>
        <div id="image-source<?= $crop->imageOptions['id'] ?>" class="row cropper-body nom ">
            <!-- Image crop area -->
            <div class="col-md-9">
                <div class="cropper-wrapper"></div>
            </div>
            <!-- preview column -->
            <div class="col-md-3">
                <div class="cropper-preview preview-lg"></div>
            </div>
            <div class="col-md-3 mt-3">
                <div class="btn-group tools">
                    <button type="button" class="btn btn-xs btn-info rotate_<?= $crop->attribute ?>" data-type="rotate" data-option="-90" title="Rotate Left">
                        <svg class="icon icon-sm icon-white">
                            <use xlink:href="<?= $spriteAsset->baseUrl ?>/material-sprite.svg#ic_rotate_left"></use>
                        </svg>
                    </button>
                    <button type="button" class="btn btn-xs btn-info rotate_<?= $crop->attribute ?>" data-type="rotate" data-option="90" title="Rotate Right">
                        <svg class="icon icon-sm icon-white">
                            <use xlink:href="<?= $spriteAsset->baseUrl ?>/material-sprite.svg#ic_rotate_right"></use>
                        </svg>
                    </button>
                </div>
            </div>
            <?php if($aspectRatio == 1.7) : ?>
                <div class="col-md-3 mt-3">
                    <p>Si consiglia il caricamento di immagini orizzontali in proporzione 16:9 (dimensione consigliata minima: 1348x758px, ideale: 1920x1080px)</p>
                </div>
            <?php endif; ?> 

        </div>
        <?php yii\bootstrap4\Modal::end(); ?>

    <?php else : ?>
        <?php Modal::begin([
            'id' => 'modal-image-crop cropper-modal-'.$crop->imageOptions['id'],
            'header' => '<h2>'.FileModule::t('amosattachments', '#crop_title').'</h2>',
            'closeButton' => [],
            'footer' => '<div class="row cropper-btns">'
            .Html::button(FileModule::t('amosattachments', '#cancel_btn'),
                ['id' => $crop->imageOptions['id'].'_button_cancel', 'class' => 'btn btn-secondary', 'data-dismiss' => 'modal'])
            .Html::button(FileModule::t('amosattachments', '#accept_btn'),
                ['id' => $crop->imageOptions['id'].'_button_accept', 'class' => 'btn btn-navigation-primary cropper-done']).'</div>',
            'size' => Modal::SIZE_LARGE,
            'clientOptions' => ['backdrop' => 'static'] //To prevent closing when you drag outside the modal window
        ]);
        ?>
        <div id="image-source<?= $crop->imageOptions['id'] ?>" class="row cropper-body nom">
            <!-- Image crop area -->
            <div class="col-md-9">
                <div class="cropper-wrapper"></div>
            </div>
            <!-- preview column -->
            <div class="col-md-3">
                <div class="cropper-preview preview-lg"></div>

                <div class="btn-group tools m-t-15 m-r-15 m-l-15 " >
                    <button type="button" class="btn btn-primary rotate_<?= $crop->attribute ?>" data-type="rotate" data-option="-90" title="Rotate Left">
                        <span class="docs-tooltip" data-animation="false">
                            <?= AmosIcons::show('rotate-left', ['class' => 'am']); ?>
                        </span>
                    </button>
                    <button type="button" class="btn btn-primary rotate_<?= $crop->attribute ?>" data-type="rotate" data-option="90" title="Rotate Right">
                        <span class="docs-tooltip" data-animation="false">
                            <?= AmosIcons::show('rotate-right', ['class' => 'am']); ?>
                        </span>
                    </button>
                </div>
                <?php if($aspectRatio == 1.7) : ?>
                    <div class="image-size-description m-t-15 m-r-15 m-l-15 small">
                        <?= Yii::t('amosattachments', '#default_message')?>
                        <!--<p>Si consiglia il caricamento di immagini orizzontali in proporzione <strong>16:9</strong>. La dimensione consigliata minima ?? <strong>1348 x 758px</strong>,
                        quella ideale ?? <strong>1920 x 1080px</strong>.</p>-->
                    </div>
                <?php endif; ?>
            </div>
            
            
        </div>
        <?php Modal::end(); ?>

    <?php endif; ?>
</div>

<?php
// SELECTION FROM GALLERY
if ($crop->enableUploadFromGallery) {
    echo \arter\amos\attachments\components\GalleryInput::widget(['attribute' => $crop->attribute]);
}
?>

<?php
UploadCropAsset::register($this);

$jcropOptions = ['inputField' => $inputField, 'jcropOptions' => $crop->jcropOptions];

$jcropOptions['maxSize'] = $crop->maxSize;

$jcropOptions = Json::encode($jcropOptions);

$jsCropper = <<<JS
    var options = {$jcropOptions};
    
    jQuery("#{$inputId}").uploadCrop(options);
JS;


$this->registerJs($jsCropper);
?>