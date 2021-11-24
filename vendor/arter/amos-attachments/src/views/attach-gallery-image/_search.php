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
 * @package    @vendor/arter/amos-attachments/src/views
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var arter\amos\attachments\models\search\AttachGalleryImageSearch $model
 * @var yii\widgets\ActiveForm $form
 */


?>
<div class="attach-gallery-image-search element-to-toggle" data-toggle-element="form-search">

    <?php $form = ActiveForm::begin([
        'action' => (isset($originAction) ? [$originAction] : ['index']),
        'method' => 'get',
        'options' => [
            'class' => 'default-form'
        ]
    ]);
    ?>

    <!-- id --> <?php // echo $form->field($model, 'id') ?>

    <!-- category_id -->
    <div class="col-md-4"> <?=
        $form->field($model, 'category_id')->textInput(['placeholder' => 'ricerca per category id']) ?>

    </div>


<!--    <div class="col-md-4">-->
<!--        --><?php //echo
//        $form->field($model, 'attachGalleryCategory')->textInput(['placeholder' => 'ricerca per '])->label('');
//        ?>
<!--    </div>-->
    <!-- gallery_id -->
    <div class="col-md-4"> <?=
        $form->field($model, 'gallery_id')->textInput(['placeholder' => 'ricerca per gallery id']) ?>

    </div>


<!--    <div class="col-md-4">-->
<!--        --><?php //echo
//        $form->field($model, 'attachGallery')->textInput(['placeholder' => 'ricerca per '])->label('');
//        ?>
<!--    </div>-->
    <!-- name -->
    <div class="col-md-4"> <?=
        $form->field($model, 'name')->textInput(['placeholder' => 'ricerca per name']) ?>

    </div>

    <!-- description -->
    <div class="col-md-4"> <?=
        $form->field($model, 'description')->textInput(['placeholder' => 'ricerca per description']) ?>

    </div>

    <!-- created_at --> <?php // echo $form->field($model, 'created_at') ?>

    <!-- updated_at --> <?php // echo $form->field($model, 'updated_at') ?>

    <!-- deleted_at --> <?php // echo $form->field($model, 'deleted_at') ?>

    <!-- created_by --> <?php // echo $form->field($model, 'created_by') ?>

    <!-- updated_by --> <?php // echo $form->field($model, 'updated_by') ?>

    <!-- deleted_by --> <?php // echo $form->field($model, 'deleted_by') ?>

    <div class="col-xs-12">
        <div class="pull-right">
            <?= Html::resetButton(Yii::t('amoscore', 'Reset'), ['class' => 'btn btn-secondary']) ?>
            <?= Html::submitButton(Yii::t('amoscore', 'Search'), ['class' => 'btn btn-navigation-primary']) ?>
        </div>
    </div>

    <div class="clearfix"></div>

    <?php ActiveForm::end(); ?>
</div>
