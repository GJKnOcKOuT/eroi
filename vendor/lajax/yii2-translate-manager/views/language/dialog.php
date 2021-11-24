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

/**
 * @author Lajos Molnár <lajax.m@gmail.com>
 *
 * @since 1.2
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $languageSource \lajax\translatemanager\models\LanguageSource */
/* @var $languageTranslate \lajax\translatemanager\models\LanguageTranslate */
?>
<div id="translate-manager-dialog">
    <div class="translate-manager-message">
        <div class="clearfix">
            <?php $form = ActiveForm::begin([
                'id' => 'transslate-manager-change-source-form',
                'action' => ['/translatemanager/language/message'],
            ]); ?>
            <?= $form->field($languageTranslate, 'id', ['enableLabel' => false])->hiddenInput(['name' => 'id', 'id' => 'language-source-id']) ?>
            <?= $form->field($languageTranslate, 'language')->dropDownList(array_merge([
                    '' => Yii::t('language', 'Source'),
                ], $languageTranslate->getTranslatedLanguageNames()), [
                    'name' => 'language_id',
                    'id' => 'translate-manager-language-source',
                ])->label(Yii::t('language', 'Choosing the language of translation'))
            ?>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="clearfix">
            <?= Html::label(Yii::t('language', 'Text to be translated'), 'translate-manager-message') ?>
            <?= Html::textarea('translate-manager-message', $languageSource->message, ['readonly' => 'readonly', 'id' => 'translate-manager-message']) ?>
        </div>
    </div>

    <div class="translate-manager-message">
        <div class="clearfix">
            <?php $form = ActiveForm::begin([
                'id' => 'transslate-manager-translation-form',
                'method' => 'POST',
                'action' => ['/translatemanager/language/save'],
            ]); ?>
            <?= $form->field($languageTranslate, 'id', ['enableLabel' => false])->hiddenInput(['name' => 'id']) ?>
            <?= $form->field($languageTranslate, 'language', ['enableLabel' => false])->hiddenInput(['name' => 'language_id']) ?>
            <?= $form->field($languageTranslate, 'translation')->textarea(['name' => 'translation', 'class' => $languageTranslate->language]) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
