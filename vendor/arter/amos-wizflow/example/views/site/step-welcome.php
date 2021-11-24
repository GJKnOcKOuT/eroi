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


use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\wizflow\WelcomeForm */
/* @var $form ActiveForm */
?>
<div class="wizflow-step-welcome">

    <div class="row">
        <div class="col-lg-2">
            <h3>Summary</h3>
            <hr/>
        </div>
        <div class="col-lg-10">
            <div class="alert alert-info">
                Let's start by introducing each other. I am <b>wizflow</b>, a mix between a wizard and a workflow. What about you ?
            </div>
            <?php $form = ActiveForm::begin([
                'action' => ['', 'nav' => 'next']
            ]); ?>

            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'email') ?>

            <div class="form-group">
                <hr/>
                <?= Html::submitButton('Next <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div><!-- wizflow-step-welcome -->
