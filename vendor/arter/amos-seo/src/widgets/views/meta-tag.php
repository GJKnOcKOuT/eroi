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

//pr($contentModel->className(), 'contentModel - meta-tag');pr($modelClass, 'model - meta-tag');pr($model->toArray(), 'il model');
//print 'getPrettyUrl: '.$contentModel->getPrettyUrl().'.<br />';
//print 'getMetaTitle: '.$contentModel->getMetaTitle().'.<br />';
//print 'getMetaDescription: '.$contentModel->getMetaDescription().'.<br />';
//print 'getMetaKeywords: '.$contentModel->getMetaKeywords().'.<br />';
?>
<?php
$titolo_field = $contentModel->titleAttribute;

$js = <<<JS
    var prettyUrlElem = $("input[id$=\"pretty_url\"]");
    //console.log('initPrettyUrl', $(prettyUrlElem).val());
    if($(prettyUrlElem).val() == '') {
        var titoloElem = $("input[id$=\"-$titolo_field\"]");
        //console.log($(titoloElem).attr('id'), $(titoloElem).length, 'input');
        if (titoloElem.length == 0) {
            titoloElem = $("textarea[id$=\"-$titolo_field\"]");
            //console.log($(titoloElem).attr('id'), $(titoloElem).length, 'textaarea');
        }
        setPrettyUrl(titoloElem);
        $(titoloElem).on('change',function(){
            setPrettyUrl(this);
        });
    }

    function setPrettyUrl(titoloElem) {
        //console.log('setPrettyUrl', $(titoloElem).val());
        var url = 
                $.ajax({
                    url: '/seo/api/prettyurl',
                    type: 'POST',
                    data: {
                        slug: $(titoloElem).val()
                    },
                    success: function (data) {
                        $(prettyUrlElem).val(data['pretty_url']);
                    }
                });
    }
   
JS;

$this->registerJs($js);
?>
<div class="row meta-tag">

    <div class="col-xs-12">
        <?= Html::tag('h3', AmosSeo::t('amosseo', '#meta_tag_title'), ['class' => 'subtitle-form']) ?>
    </div>

    <div class="col-xs-12">
        <?= $form->field($model, 'pretty_url')->textInput(['maxlength' => true, 'placeholder' => AmosSeo::t('amosseo', '#pretty_url_field_placeholder')])->hint(AmosSeo::t('amosseo', '#pretty_url_field_hint')) ?>
        <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true, 'placeholder' => AmosSeo::t('amosseo', '#meta_title_field_placeholder')])->hint(AmosSeo::t('amosseo', '#meta_title_field_hint')) ?>
        <?= $form->field($model, 'meta_description')->textarea(['maxlength' => true, 'placeholder' => AmosSeo::t('amosseo', '#meta_description_field_placeholder')])->hint(AmosSeo::t('amosseo', '#meta_description_field_hint')) ?>
        <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true, 'placeholder' => AmosSeo::t('amosseo', '#meta_keywords_field_placeholder')])->hint(AmosSeo::t('amosseo', '#meta_keywords_field_hint')) ?>
    </div>

</div>

