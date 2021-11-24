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
/* @var $model app\models\wizflow\GreenForm */
/* @var $form ActiveForm */
?>
<div class="wizflow-step-green">

    <div class="row">
        <div class="col-lg-2">
            <h3>Summary</h3>
            <hr/>
            <?php
            foreach ($path as $step) {
                echo $step->summary() . '<br/>';
            }
            ?>
        </div>
        <div class="col-lg-10">
            <div class="alert alert-success">
                All right, green then. Do you have something green in mind ?
            </div>

            <?php $form = ActiveForm::begin([
                'action' => ['', 'nav' => 'next']
            ]); ?>

            <?= $form->field($model, 'greenStuff') ?>

            <div class="form-group">
                <hr/>
                <?= Html::a('<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Prev', ['', 'nav' => 'prev'], ['class' => 'btn  btn-primary', 'role' => 'button']) ?>&nbsp;
                <?= Html::submitButton('Next <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div><!-- wizflow-step-green -->
