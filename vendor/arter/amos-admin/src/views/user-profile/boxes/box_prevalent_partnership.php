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
 * @package    arter\amos\admin\views\user-profile\boxes
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\core\helpers\Html;
use arter\amos\core\interfaces\OrganizationsModuleInterface;
use arter\amos\core\utilities\ModalUtility;
use kartik\alert\Alert;

/**
 * @var yii\web\View $this
 * @var arter\amos\core\forms\ActiveForm $form
 * @var arter\amos\admin\models\UserProfile $model
 * @var arter\amos\core\user\User $user
 */

/** @var AmosAdmin $adminModule */
$adminModule = Yii::$app->controller->module;

?>

<?= ModalUtility::createConfirmModal([
    'id' => 'removePrevalentPartnershipPopup',
    'modalDescriptionText' => AmosAdmin::t('amosadmin', '#remove_prevalent_partnerhip_confirm'),
    'confirmBtnLink' => Yii::$app->urlManager->createUrl([
        '/admin/user-profile/remove-prevalent-partnership',
        'id' => $model->id
    ]),
    'confirmBtnOptions' => ['id' => 'confirm-remove-pp-btn', 'class' => 'btn btn-primary'],
    'cancelBtnOptions' => [
        'title' => AmosAdmin::t('amosadmin', '#remove_prevalent_partnerhip_cancel_title_link'),
        'class' => 'btn btn-secondary',
        'data-dismiss' => 'modal'
    ],
]); ?>
<?= ModalUtility::createConfirmModal([
    'id' => 'selectPrevalentPartnershipPopup',
    'modalDescriptionText' => AmosAdmin::t('amosadmin', '#select_prevalent_partnerhip_confirm'),
    'confirmBtnLink' => Yii::$app->urlManager->createUrl([
        '/admin/user-profile/associate-prevalent-partnership',
        'id' => $model->id,
        'viewM2MWidgetGenericSearch' => true
    ]),
    'confirmBtnOptions' => ['id' => 'confirm-associate-pp-btn', 'class' => 'btn btn-primary'],
    'cancelBtnOptions' => ['title' => AmosAdmin::t('amosadmin', '#select_prevalent_partnerhip_cancel_title_link'),
        'class' => 'btn btn-secondary',
        'data-dismiss' => 'modal'
    ],
]); ?>

<?php
$js = <<<JS
$('#confirm-remove-pp-btn').on("click", function(e) {
    e.preventDefault();
    $.ajax({
        url: $(this).attr('href'),
        type : "POST"
    });
    return false;
});
$('#confirm-associate-pp-btn').on("click", function(e) {
    e.preventDefault();
    window.location.href = $(this).attr('href');
    return false;
});
JS;
$this->registerJs($js);
?>

<section class="wrap-cooperation box-light-grey">
    <div class="col-xs-12">
        <h3><?= AmosAdmin::t('amosadmin', '#cooperation'); ?></h3>
    </div>
    <div class="col-xs-12">
        <p><?= AmosAdmin::t('amosadmin', 'Choose the organization with which you mainly work with those already on the platform. If the organization is not present, you may be required to register later.') ?></p>
    </div>
    <div id="prevalent-partnership-section" class="col-xs-12">
        <?php if (!is_null($model->prevalentPartnership)): ?>
            <div class="prevalent-partnership-section col-xs-12">
                <div class="col-xs-3">
                    <div class="img-profile">
                        <?php
                        /** @var OrganizationsModuleInterface $organizationsModule */
                        $organizationsModuleName = $adminModule->getOrganizationModuleName();
                        $organizationsModule = Yii::$app->getModule($organizationsModuleName);
                        /** @var yii\base\Widget $widgetClass */
                        $widgetClass = $organizationsModule->getOrganizationCardWidgetClass();
                        ?>
                        <?= $widgetClass::widget(['model' => $model->prevalentPartnership]); ?>
                    </div>
                </div>
                <div class="col-xs-9 title">
                    <?= $model->prevalentPartnership->getTitle() ?>
                </div>
            </div>
            <div class="col-xs-12 nop text-right">
                <?= Html::a(AmosAdmin::t('amosadmin', '#delete_prevalent_partnership'), ['/admin/user-profile/remove-prevalent-partnership', 'id' => $model->id], [
                    'data-toggle' => 'modal',
                    'data-target' => '#removePrevalentPartnershipPopup',
                    'class' => 'text-danger m-r-15']) ?>

                <?= Html::a(AmosAdmin::t('amosadmin', '#edit_prevalent_partnership'), ['/admin/user-profile/associate-prevalent-partnership', 'id' => $model->id, 'viewM2MWidgetGenericSearch' => true], [
                    'data-toggle' => 'modal',
                    'data-target' => '#selectPrevalentPartnershipPopup',
                    'class' => 'm-r-15']) ?>
            </div>
        <?php else: ?>
            <div class="col-xs-12 m-t-15 nop">
                <div><?= AmosAdmin::tHtml('amosadmin', 'Prevalent partnership not selected') ?></div>
                <?php if ($model->isNewRecord): ?>
                    <?= Alert::widget([
                        'type' => Alert::TYPE_WARNING,
                        'body' => AmosAdmin::t('amosadmin', '#prevalent_partnership_box_new_record_message'),
                        'closeButton' => false
                    ]); ?>
                <?php else: ?>
                    <div><?= Html::a(AmosAdmin::t('amosadmin', 'Select prevalent partnership'), ['/admin/user-profile/associate-prevalent-partnership', 'id' => $model->id, 'viewM2MWidgetGenericSearch' => true], [
                            'data-toggle' => 'modal',
                            'data-target' => '#selectPrevalentPartnershipPopup',
                            'class' => 'text-danger m-r-15']) ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <?= $form->field($model, 'prevalent_partnership_id')->hiddenInput()->label(false) ?>
</section>
