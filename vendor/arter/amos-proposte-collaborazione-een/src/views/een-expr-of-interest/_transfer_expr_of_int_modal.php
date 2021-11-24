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

/**@var $model \arter\amos\een\models\EenExprOfInterest */

$form = \arter\amos\core\forms\ActiveForm::begin();
?>

    <div class="col-xs-12 nop">
        <h2><?= $model->eenPartnershipProposal->content_title ?></h2>
        <i><?= \arter\amos\een\AmosEen::t('amoseen','#code_proposal_partnership:') . ' ' . $model->eenPartnershipProposal->reference_external ?></i>
    </div>
    <?php echo $form->field($model, 'een_staff_id')->widget(\kartik\select2\Select2::className(),[
        'data' => \yii\helpers\ArrayHelper::map(\arter\amos\een\models\EenStaff::find()->all(), 'id', 'user.userProfile.nomeCognome'),
        'options' => ['placeholder' => \arter\amos\een\AmosEen::t('amoseen','Select...')],
        'pluginOptions' => [
            'allowClear' => true,
        ]
    ])?>
<?= \arter\amos\core\forms\CloseSaveButtonWidget::widget(['model' => $model]); ?>


<?php \arter\amos\core\forms\ActiveForm::end(); ?>