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
 * @package    @backend/modules/aster_een/views
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\CloseSaveButtonWidget;
use arter\amos\core\forms\editors\Select;
use arter\amos\core\forms\RequiredFieldsTipWidget;
use arter\amos\core\forms\Tabs;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use kartik\datecontrol\DateControl;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use yii\helpers\Url;
use yii\redactor\widgets\Redactor;

/**
 * @var yii\web\View $this
 * @var arter\amos\een\models\EenTagEen $model
 * @var yii\widgets\ActiveForm $form
 */


?>
<div class="een-tag-een-form col-xs-12 nop">

    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'een-tag-een_' . ((isset($fid)) ? $fid : 0),
            'data-fid' => (isset($fid)) ? $fid : 0,
            'data-field' => ((isset($dataField)) ? $dataField : ''),
            'data-entity' => ((isset($dataEntity)) ? $dataEntity : ''),
            'class' => ((isset($class)) ? $class : '')
        ]
    ]);
    ?>
    <?php // $form->errorSummary($model, ['class' => 'alert-danger alert fade in']); ?>

	<div class="row">
		<div class="col-xs-12"><h2 class="subtitle-form">Settings</h2>
			<div class="col-md-8 col xs-12"><!-- description string -->
                <?= $form->field($model, 'id_een')->textInput(['maxlength' => true]) ?><!-- created_at datetime -->
                <?php // $form->field($model, 'name')->textInput(['maxlength' => true]) ?> 
                <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?><!-- id_een string -->
<!--                -->
<!--                < ?= $form->field($model, 'created_at')->widget(\kartik\datetime\DateTimePicker::classname(), [-->
<!--                    'options' => ['placeholder' => Yii::t('amoscore', 'Set time')],-->
<!--                    'pluginOptions' => [-->
<!--                        'autoclose' => true-->
<!--                    ]-->
<!--                ]) ? >-->
				<?= RequiredFieldsTipWidget::widget(); ?><?= CloseSaveButtonWidget::widget(['model' => $model]); ?><?php ActiveForm::end(); ?></div>
			<div class="col-md-4 col xs-12"></div>
		</div>
		<div class="clearfix"></div>

	</div>
</div>
