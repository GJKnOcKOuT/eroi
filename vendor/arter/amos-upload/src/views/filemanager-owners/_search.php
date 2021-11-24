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
* @var arter\amos\upload\models\FilemanagerOwnersSearch $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="filemanager-owners-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

        <?= $form->field($model, 'mediafile_id') ?>

    <?= $form->field($model, 'owner_id') ?>

    <?= $form->field($model, 'owner') ?>

    <?= $form->field($model, 'owner_attribute') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('amosupload', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('amosupload', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
