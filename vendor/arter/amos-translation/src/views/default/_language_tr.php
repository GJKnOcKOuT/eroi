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


use arter\amos\core\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use arter\amos\translation\AmosTranslation;
use arter\amos\translation\models\TranslationConf;

?>
<div class="search">

    <?php 
    $form = ActiveForm::begin([
                'action' => ['view-tr', 'id' => filter_input(INPUT_GET, 'id'), 'lang' => filter_input(INPUT_GET, 'lang'), 'namespace' => filter_input(INPUT_GET, 'namespace'), 'url' => filter_input(INPUT_GET, 'url')],
                'method' => 'get',
                'options' => [
                    'data-pjax' => true,
                    'id' => 'filter_lang',
                    'class' => 'default-form',
                ]
    ]);
    ?>    
    <div class="container" id="container-filter">
    <div class="col-md-6">
        <p>
            <strong>    
                <?= $model->getAttributeLabel('language_source') ?>
            </strong>
                <?=
                        $form->field($model, 'language_source')
                        ->dropDownList(\yii\helpers\ArrayHelper::map(TranslationConf::getStaticAllActiveLanguages(true, filter_input(INPUT_GET, 'namespace'))->andWhere(['!=', 'language_id', filter_input(INPUT_GET, 'lang')])->orderBy('language_id')->all(), 'language_id', 'language_id'), ['prompt' => AmosTranslation::t('amostranslation', 'Source contents {lang}', ['lang' => (isset($this->context->module->defaultLanguage)? '(' . $this->context->module->defaultLanguage . ')' : '')]), 'id' => 'source_lang_id'])
                        ->label(false);
                ?>             
            
        </p>
    </div>

    <div class="col-md-6 m-t-30">                 
            <?= Html::submitButton(AmosTranslation::tHtml('amostranslation', 'Change source language'), ['class' => 'btn btn-navigation-primary']) ?>      
    </div>
    </div>
    <div class="clearfix"></div> 
    <?php
    ActiveForm::end();
    ?>
</div>