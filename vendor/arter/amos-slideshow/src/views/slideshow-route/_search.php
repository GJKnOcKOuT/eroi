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
 * @package    arter\amos\slideshow
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\slideshow\AmosSlideshow;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \arter\amos\slideshow\models\search\SlideshowRouteSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="slideshow-route-search element-to-toggle" data-toggle-element="form-search">
    <div class="col-xs-12"><h2><?= AmosSlideshow::tHtml('amosslideshow', 'Cerca per:') ?></h2></div>

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'default-form'
        ]
    ]); ?>

    <div class="col-sm-6 col-lg-4">    <?= $form->field($model, 'id') ?></div>
    <div class="col-sm-6 col-lg-4">    <?= $form->field($model, 'route') ?></div>
    <div class="col-sm-6 col-lg-4">    <?= $form->field($model, 'already_view') ?></div>
    <div class="col-sm-6 col-lg-4">    <?= $form->field($model, 'slideshow_id') ?></div>
    <div
        class="col-sm-6 col-lg-4">    <?= $form->field($model, 'created_at') ?></div> <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <div class="col-xs-12">
        <div class="pull-right">
            <?= Html::resetButton(AmosSlideshow::t('amosslideshow', 'Reset'), ['class' => 'btn btn-secondary']) ?>
            <?= Html::submitButton(AmosSlideshow::t('amosslideshow', 'Search'), ['class' => 'btn btn-navigation-primary']) ?>
        </div>
    </div>

    <div class="clearfix"></div>
    <!--a><p class="text-center">Ricerca avanzata<br>
                < ?=AmosIcons::show('caret-down-circle');?>
            </p></a-->
    <?php ActiveForm::end(); ?>

</div>
