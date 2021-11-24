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


use arter\amos\cwh\AmosCwh;
use yii\helpers\Html;
use arter\amos\core\forms\ActiveForm;

/**
 * @var yii\web\View $this
 * @var arter\amos\cwh\models\search\CwhNodiSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="cwh-nodi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cwh_config_id') ?>

    <?= $form->field($model, 'record_id') ?>

    <?= $form->field($model, 'classname') ?>

    <div class="form-group">
        <?= Html::submitButton(AmosCwh::t('amoscwh', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(AmosCwh::t('amoscwh', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
