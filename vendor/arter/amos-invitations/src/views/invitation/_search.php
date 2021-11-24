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
 * @package    arter\amos\invitations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var \arter\amos\invitations\models\search\InvitationSearch $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="invitation-search element-to-toggle" data-toggle-element="form-search">
    <div class="col-xs-12"><h2>Cerca per:</h2></div>

    <?php $form = ActiveForm::begin([
        'action' => Yii::$app->controller->action->id,
        'method' => 'get',
        'options' => [
            'class' => 'default-form'
        ]
    ]);

    echo Html::hiddenInput("enableSearch", "1");
    echo Html::hiddenInput("currentView", Yii::$app->request->getQueryParam('currentView'));
    ?>


    <div class="col-sm-6 col-lg-4">
        <?= $form->field($model, 'name') ?>
    </div>
    <div class="col-sm-6 col-lg-4">
        <?= $form->field($model, 'surname') ?>
    </div>
    <div class="col-sm-6 col-lg-4">
        <?= $form->field($model, 'email') ?>
    </div>
<!--    <div class="col-sm-6 col-lg-4">    -->
<!--        --><?php //echo $form->field($model, 'message') ?>
<!--    </div>-->
<!--    <div class="col-sm-6 col-lg-4">    -->
<!--        --><?php //echo $form->field($model, 'send_time') ?>
<!--    </div>    -->
    <?php // echo $form->field($model, 'send') ?>

    <?php // echo $form->field($model, 'invitation_user_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <div class="col-xs-12">
        <div class="pull-right">
            <?= Html::resetButton(Yii::t('amosinvitations', 'Reset'), ['class' => 'btn btn-secondary']) ?>
            <?= Html::submitButton(Yii::t('amosinvitations', 'Search'), ['class' => 'btn btn-navigation-primary']) ?>
        </div>
    </div>

    <div class="clearfix"></div>
<!--a><p class="text-center">Ricerca avanzata<br>
            < ?=AmosIcons::show('caret-down-circle');?>
        </p></a-->
    <?php ActiveForm::end(); ?>

</div>
