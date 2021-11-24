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
use arter\amos\core\forms\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use arter\amos\core\forms\Tabs;
use arter\amos\core\forms\CloseSaveButtonWidget;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var arter\amos\admin\models\TokenGroup $model
 * @var yii\widgets\ActiveForm $form
 */


?>

<div class="token-group-form col-xs-12 nop">

    <?php $form = ActiveForm::begin(); ?>




    <?php $this->beginBlock('general'); ?>

    <div class="col-lg-6 col-sm-6">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-lg-6 col-sm-6">
        <?= $form->field($model, 'string_code')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-lg-12 col-sm-12">
        <?= $form->field($model, 'Description')->textarea(['rows' => 2, 'maxlength' => true]) ?>
    </div>

    <div class="col-lg- col-sm-6">
        <?= $form->field($model, 'url_redirect')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-lg-4 col-sm-4">
        <?= $form->field($model, 'expire_date')->widget(DateControl::className(),[
            'type' => DateControl::FORMAT_DATETIME
        ]) ?>
    </div>

    <div class="col-lg-2 col-sm-2 m-t-20">
        <?= $form->field($model, 'consumable')->checkbox() ?>
    </div>

    <div class="col-lg-8 col-sm-8">
        <?= $form->field($model, 'target_class')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-lg-4 col-sm-4">
        <?= $form->field($model, 'target_id')->textInput() ?>
    </div>

    <?php if(!$model->isNewRecord){ ?>
        <div class="col-lg-12 col-sm-12">
            <?= \arter\amos\core\views\AmosGridView::widget([
                    'dataProvider' => $dataProvider,
                'columns' => [
                        'user.userProfile.nomeCognome',
                        'token',
                        [
                            'attribute' => 'created_at',
                            'format' => 'date'
                        ]
                ]
            ])?>
        </div>
    <?php } ?>




    <div class="clearfix"></div>
    <?php $this->endBlock('general'); ?>

    <?php $itemsTab[] = [
        'label' => Yii::t('cruds', 'general'),
        'content' => $this->blocks['general'],
    ];
    ?>

    <?= Tabs::widget(
        [
            'encodeLabels' => false,
            'items' => $itemsTab
        ]
    );
    ?>
    <?= CloseSaveButtonWidget::widget(['model' => $model]); ?>
    <?php ActiveForm::end(); ?>
</div>
