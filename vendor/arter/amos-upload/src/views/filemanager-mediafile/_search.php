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
 * @package    arter\amos\upload
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var arter\amos\upload\models\FilemanagerMediafileSearch $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="filemanager-mediafile-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

        <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'filename') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'alt') ?>

    <?php // echo $form->field($model, 'size') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'thumbs') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('amosupload', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('amosupload', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
