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
 * @package    arter\amos\seo
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
use arter\amos\seo\AmosSeo;
use arter\amos\core\helpers\Html;
use arter\amos\attachments\components\AttachmentsInput;

//print 'getOgTitle: '.$contentModel->getOgTitle().'.<br />';
//print 'getOgDescription: '.$contentModel->getOgDescription().'.<br />';
//print 'getOgImageUrl: '.$contentModel->getOgImageUrl().'.<br />';
//print 'getOgType: '.$contentModel->getOgType().'.<br />';

?>

<div class="row social-tag">

    <div class="col-xs-12">
        <?= Html::tag('h3', AmosSeo::t('amosseo', '#social_tag_title'), ['class' => 'subtitle-form']) ?>
    </div>
    <div class="col-md-8 col-xs-12">
        <?= $form->field($model, 'og_title')->textInput(['maxlength' => true, 'placeholder' => AmosSeo::t('amosseo', '#og_title_field_placeholder')])->hint(AmosSeo::t('amosseo', '#og_title_field_hint')) ?>
        <?= $form->field($model, 'og_description')->textarea(['maxlength' => true, 'placeholder' => AmosSeo::t('amosseo', '#og_description_field_placeholder')])->hint(AmosSeo::t('amosseo', '#og_description_field_hint')) ?>
        <?= $form->field($model, 'og_type')->dropdownList($ogTypeList, ['prompt' => AmosSeo::t('amosseo', '#og_type_field_prompt')])->hint(AmosSeo::t('amosseo', '#og_type_field_hint')) ?>
    </div>
    <div class="col-md-4 col-xs-12">

        <div class="col-xs-12 nop">

            <?= $form->field($model,
                'ogImage')->widget(AttachmentsInput::classname(), [
                'options' => [ // Options of the Kartik's FileInput widget
                    'multiple' => false, // If you want to allow multiple upload, default to false
                    'accept' => "image/*"
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
            ])->label(AmosSeo::t('amosseo', '#og_image_field'))->hint(AmosSeo::t('amosseo', '#og_image_field_hint')) ?>


        </div>
    </div>

</div>

