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
use arter\amos\core\views\DataProviderView;
use yii\widgets\Pjax;
use yii\helpers\StringHelper;
use yii\helpers\Inflector;
use arter\amos\translation\AmosTranslation;
use arter\amos\translation\models\TranslationConf;
use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\CloseSaveButtonWidget;
use arter\amos\core\forms\TextEditorWidget;

\arter\amos\translation\assets\AmosTranslationAsset::register($this);

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\modules\registry\models\search\ProfessionalProfilesSearch $model
 */
$url = filter_input(INPUT_GET, 'url');
if (!$url) {
    $url = filter_input(INPUT_POST, 'url');
}
$module = $this->context->module;

$rteClientOptions = array_merge([
    'placeholder' => AmosTranslation::t('amostranslation', '#description_field_placeholder'),
    'lang' => substr(Yii::$app->language, 0, 2)], $module->clientOptionsRTE);

$this->title = "$classname #{$source[$pk]}: ".AmosTranslation::t('amostranslation', 'translation into')." $lang";
$prev        = \Yii::$app->request->referrer;
if (strpos($prev, '/translation/default/records') !== false) {
    $this->params['breadcrumbs'][] = ['label' => AmosTranslation::t('amostranslation', 'Translate manager'), 'url' => ['/translation']];
    $this->params['breadcrumbs'][] = ['label' => AmosTranslation::t('amostranslation', 'Translate contents'), 'url' => [
            $url]];
} else {
    $this->params['breadcrumbs'][] = ['label' => AmosTranslation::t('amostranslation', '#Original_content'), 'url' => $prev];
}

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form">
    <?php
    echo $this->render('_language', ['model' => $model]);

    $form = ActiveForm::begin();
    if (!$model->isNewRecord):
        ?>
        <?php
        $workflowId = (defined("$modelClassName::TR_WORKFLOW") ? $modelClassName::TR_WORKFLOW : null);
        if ($workflowId !== null) {
            ?>
            <?=
            \arter\amos\core\forms\WorkflowTransitionWidget::widget([
                'form' => $form,
                'model' => $model,
                'workflowId' => $workflowId,
                'classDivIcon' => 'pull-left',
                'classDivMessage' => 'pull-left message',
            ]);
            ?>
            <?php
        }
    endif;
    ?>

    <?= $form->field($model, $pk)->hiddenInput()->label(false); ?>
    <?php foreach ((array) $stringField as $string) { ?>
        <div class="row">
            <div class="col-lg-12">
                <p><?= AmosTranslation::tHtml('amostranslation', 'Source content of') ?> <strong><?= $model->getAttributeLabel($string) ?></strong><?=
                    ($model->language_source) ? " ({$model->language_source})" : ''
                    ?></p>
                <div class="bordered-box color-source-content"><?= $source[$string] ?></div>
            </div>
            <div class="col-lg-12">
                <?= $form->field($model, $string)->textInput() ?>
            </div>
        </div>
    <?php } ?>
    <?php foreach ((array) $textField as $text) { ?>
        <div class="row">
            <div class="col-lg-12">
                <p><?= AmosTranslation::tHtml('amostranslation', 'Source content of') ?> <strong><?= $model->getAttributeLabel($text) ?></strong><?=
                    ($model->language_source) ? " ({$model->language_source})" : ''
                    ?></p>
                <div class="bordered-box color-source-content">
                    <?=
                    ($module->enableRTE && in_array($text, $rteAttributes)) ? \Yii::$app->formatter->asHtml($source[$text])
                            : $source[$text]
                    ?>
                </div>
            </div>
            <div class="col-lg-12">
                <?=
                ($module->enableRTE && in_array($text, $rteAttributes)) ? $form->field($model, $text)->widget(TextEditorWidget::className(),
                        [
                        'clientOptions' => $module->clientOptionsRTE,
                    ]) : $form->field($model, $text)->textarea(['rows' => 4])
                ?>
            </div>
        </div>
    <?php } ?>

    <div class="form-group">
        <?= CloseSaveButtonWidget::widget(['model' => $model]); ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
