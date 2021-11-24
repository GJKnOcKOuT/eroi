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
 * @package    arter\amos\faq
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use arter\amos\faq\AmosFaq;

/**
 * @var yii\web\View $this
 * @var arter\amos\faq\models\FaqSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="faq-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'domanda') ?>

    <?= $form->field($model, 'risposta') ?>

    <?= $form->field($model, 'order') ?>

    <?php // $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <?php // echo $form->field($model, 'version') ?>

    <?php // echo $form->field($model, 'faq_categories_id') ?>

    <?php // echo $form->field($model, 'faq_stato_id') ?>

    <?php echo $form->field($model, 'faq_widgets_id') ?>


    <div class="form-group">
        <?= Html::submitButton(AmosFaq::t('amosfaq', 'Cerca'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(AmosFaq::t('amosfaq', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
