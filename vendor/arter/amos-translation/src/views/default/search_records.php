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

    use arter\amos\translation\AmosTranslation;
    use yii\helpers\Html;
    use arter\amos\translation\utility\TranslationUtility;
?>
<?php
$attributesToTranslate = TranslationUtility::getAttributesToTranslate($namespace);

$form = \arter\amos\core\forms\ActiveForm::begin(['method' => 'get']); ?>
<div class="col-xs-4">
    <?php
    echo $form->field($model,'isTranslated')->widget(\kartik\select2\Select2::className(),[
        'data' => ['1' => AmosTranslation::t('amostranslation', 'Not translated'), '2' => AmosTranslation::t('amostranslation', 'Translated')],
        'options' => [
            'placeholder' => AmosTranslation::t('amostranslation', 'Select...'),
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label(AmosTranslation::t('amostranslation', 'Translation'));
    ?>
</div>
<?php foreach ($attributesToTranslate as $attribute){ ?>
    <div class="col-xs-4">
        <div class="col-xs-12 form-group nop">
            <label class="control-label"><?= $attribute ?></label>
            <?= Html::textInput($attribute, !empty($model->attributes[$attribute]) ? $model->attributes[$attribute]: '',['class' => 'form-control']);?>
        </div>
    </div>
<?php }?>

<div class="col-xs-12">
    <div class="pull-right">
        <?= Html::a(AmosTranslation::t('amostranslation', 'Annulla'),
            [Yii::$app->controller->action->id,
                'namespace' => Yii::$app->request->getQueryParam('namespace'),
                'lang' => Yii::$app->request->getQueryParam('lang')
            ],
            ['class' => 'btn btn-secondary']) ?>
        <?= Html::submitButton(AmosTranslation::t('amostranslation', 'Cerca'), ['class' => 'btn btn-navigation-primary']) ?>
    </div>
</div>

<?php \arter\amos\core\forms\ActiveForm::end();