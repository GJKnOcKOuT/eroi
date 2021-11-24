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
 * @package    @vendor/arter/amos-community/src/views 
 * @author     Elite Division S.r.l.
 */
use arter\amos\core\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;

/**
* @var yii\web\View $this
* @var arter\amos\community\models\CommunityUserFieldSearch $model
* @var yii\widgets\ActiveForm $form
*/


?>
<div class="community-user-field-search element-to-toggle" data-toggle-element="form-search">

    <?php $form = ActiveForm::begin([
    'action' => (isset($originAction) ? [$originAction] : ['index']),
    'method' => 'get',
    'options' => [
    'class' => 'default-form'
    ]
    ]);
    ?>

    <!-- id -->  <?php // echo $form->field($model, 'id') ?>

 <!-- community_id -->
<div class="col-md-4"> <?= 
$form->field($model, 'community_id')->textInput(['placeholder' => 'ricerca per community id' ]) ?>

 </div> 


                <div class="col-md-4">
                    <?= 
                    $form->field($model, 'community')->textInput(['placeholder' => 'ricerca per '])->label('');
                     ?> 
                </div>
                <!-- user_field_type_id -->
<div class="col-md-4"> <?= 
$form->field($model, 'user_field_type_id')->textInput(['placeholder' => 'ricerca per user field type id' ]) ?>

 </div> 


                <div class="col-md-4">
                    <?= 
                    $form->field($model, 'communityUserFieldType')->textInput(['placeholder' => 'ricerca per '])->label('');
                     ?> 
                </div>
                <!-- name -->
<div class="col-md-4"> <?= 
$form->field($model, 'name')->textInput(['placeholder' => 'ricerca per name' ]) ?>

 </div> 

<!-- description -->
<div class="col-md-4"> <?= 
$form->field($model, 'description')->textInput(['placeholder' => 'ricerca per description' ]) ?>

 </div> 

<!-- tooltip -->
<div class="col-md-4"> <?= 
$form->field($model, 'tooltip')->textInput(['placeholder' => 'ricerca per tooltip' ]) ?>

 </div> 

<!-- required -->
<div class="col-md-4"> <?= 
$form->field($model, 'required')->textInput(['placeholder' => 'ricerca per required' ]) ?>

 </div> 

<!-- created_at -->  <?php // echo $form->field($model, 'created_at') ?>

 <!-- updated_at -->  <?php // echo $form->field($model, 'updated_at') ?>

 <!-- deleted_at -->  <?php // echo $form->field($model, 'deleted_at') ?>

 <!-- created_by -->  <?php // echo $form->field($model, 'created_by') ?>

 <!-- updated_by -->  <?php // echo $form->field($model, 'updated_by') ?>

 <!-- deleted_by -->  <?php // echo $form->field($model, 'deleted_by') ?>

     <div class="col-xs-12">
        <div class="pull-right">
            <?= Html::resetButton(Yii::t('amoscore', 'Reset'), ['class' => 'btn btn-secondary']) ?>
            <?= Html::submitButton(Yii::t('amoscore', 'Search'), ['class' => 'btn btn-navigation-primary']) ?>
        </div>
    </div>

    <div class="clearfix"></div>

    <?php ActiveForm::end(); ?>
</div>
