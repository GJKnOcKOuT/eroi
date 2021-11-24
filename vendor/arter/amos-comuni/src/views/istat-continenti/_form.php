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
use arter\amos\comuni\AmosComuni;

/**
 * @var yii\web\View $this
 * @var arter\amos\comuni\models\IstatContinenti $model
 * @var yii\widgets\ActiveForm $form
 */


?>

<div class="istat-continenti-form col-xs-12 nop">

    <?php $form = ActiveForm::begin(); ?>




    <?php $this->beginBlock('principale'); ?>

    <div class="col-lg-6 col-sm-6">

        <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="clearfix"></div>
    <?php $this->endBlock('principale'); ?>

    <?php $itemsTab[] = [
        'label' => AmosComuni::t('amoscomuni', 'Principale '),
        'content' => $this->blocks['principale'],
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
