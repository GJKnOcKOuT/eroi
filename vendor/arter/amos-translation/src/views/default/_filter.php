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
?>
<div class="search">

    <?php   
    $form = ActiveForm::begin([
                'action' => ['contents'],
                'method' => 'get',               
                'options' => [
                    'class' => 'default-form',                   
                ]
    ]);
    ?>    
    <div class="col-md-4 m-t-30">        
        <p>
            <strong>
                <?= AmosTranslation::tHtml('amostranslation', 'Default language: ') ?>
                <?= (isset($this->context->module->defaultLanguage) ? $this->context->module->defaultLanguage : \Yii::$app->language) ?>
            </strong>
        </p>
    </div>
    <div class="col-md-4">
        <p>
            <strong>         
                <?=
                $model->getAttributeLabel('plugin') .
                $form->field($model, 'plugin')->dropDownList(\yii\helpers\ArrayHelper::map($model->getAllPlugins()->orderBy('plugin')->all(), 'plugin', 'plugin'), ['prompt' => AmosTranslation::t('amostranslation', 'Select ...')])->label(false);
                ?>             
            </strong>
        </p>
    </div>
    <div class="col-md-4">
        <p>
            <strong>           
                <?=
                $model->getAttributeLabel('language_id') .
                $form->field($model, 'language_id')->dropDownList(\yii\helpers\ArrayHelper::map($model->getAllActiveLanguages()->orderBy('name')->all(), 'language_id', 'name'), ['prompt' => AmosTranslation::t('amostranslation', 'Select ...')])->label(false);
                ?>             
            </strong>
        </p>
    </div>


    <div class="col-xs-12">
        <div class="pull-right">            
            <?= Html::submitButton(AmosTranslation::tHtml('amostranslation', 'Filter'), ['class' => 'btn btn-navigation-primary']) ?>
        </div>
    </div>

    <div class="clearfix"></div>
    <!--a><p class="text-center">Ricerca avanzata<br>
            < ?=AmosIcons::show('caret-down-circle');?>
        </p></a-->
    <?php
    ActiveForm::end();    
    ?>
</div>