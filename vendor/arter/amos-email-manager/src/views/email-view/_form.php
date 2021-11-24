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
 * @package    @vendor/arter/amos-email-manager/src/views
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
use arter\amos\core\forms\TextEditorWidget;

/**
 * @var yii\web\View $this
 * @var arter\amos\emailmanager\models\EmailView $model
 * @var yii\widgets\ActiveForm $form
 */

$params = json_decode($model->params);
?>
<div class="email-view-form col-xs-12 nop">

    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'email-view_' . ((isset($fid)) ? $fid : 0),
            'data-fid' => (isset($fid)) ? $fid : 0,
            'data-field' => ((isset($dataField)) ? $dataField : ''),
            'data-entity' => ((isset($dataEntity)) ? $dataEntity : ''),
            'class' => ((isset($class)) ? $class : '')
        ]
    ]);
    ?>
    <?php // $form->errorSummary($model, ['class' => 'alert-danger alert fade in']); ?>

    <div class="row">
        <div class="col-xs-12">

            <div class="col-lg-6 col-sm-6">
                <?= $form->field($model, 'type')->textInput() ?>
            </div>
            <div class="col-lg-6 col-sm-6">
                <?= $form->field($model, 'description')->textArea() ?>
            </div>

            <div class="col-md-8 col-xs-12"><!-- module string -->
                <?= $form->field($model, 'content')->widget(TextEditorWidget::className(),
                    [
                        'clientOptions' => [
                            'lang' => substr(Yii::$app->language, 0, 2),
                            'plugins' => 'code',
                            'toolbar' => "undo redo | backcolor forecolor | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code"
                        ]
                    ]) ?>
            </div>
            <div class="col-md-4 col-xs-12">
                <br/>
                <label><?= Yii::t('emailmanager', 'Parametri Disponibili') ?></label>
                <?php foreach ($params as $param=>$type) {
                    $typeTranslate = arter\amos\emailmanager\AmosEmail::t('amosemail', $model->view.'_'.$param);

                    echo "<br/><b>{{$param}}</b>: {$typeTranslate}";
                } ?>
            </div>
            <div class="col-xs-12">
                <?= RequiredFieldsTipWidget::widget(); ?><?= CloseSaveButtonWidget::widget(['model' => $model]); ?><?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="clearfix"></div>

    </div>
</div>
