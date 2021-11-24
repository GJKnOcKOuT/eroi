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

if(!$model->isNewRecord) {
    $this->registerCss(<<<CSS
    .facilitator-roles-enabled,
     .facilitator-roles-disabled {
        display: none;
    }

    .disabled-field {
        pointer-events:none;
        background-color: #eee !important;
        opacity: 1;
    }

CSS
    );

    $facilitatorRolesRemovesMessage = \arter\amos\admin\AmosAdmin::t('amosadmin', '#facilitator_roles_removed');
    /*
     <div id="flash-facilitator-roles-removed" class="alert-success alert fade" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        </div>
    */

$this->registerJs(<<<JS
    function facilitatorRoleStatus(enabled) {
        if(enabled) {
            $(".facilitator-roles-disabled").removeClass("facilitator-roles-disabled");
            $("#enable-facilitator-button").addClass("facilitator-roles-enabled");
        } else {
            $(".facilitator-roles-enabled").removeClass("facilitator-roles-enabled");
            $("#disable-facilitator-button").addClass("facilitator-roles-disabled");
            $("#enabled-facilitator-roles-box").addClass("facilitator-roles-disabled");
        }
    }

    if($("#userprofile-enable_facilitator_box").val() === "1") {
        facilitatorRoleStatus(true);
    } else {
        facilitatorRoleStatus(false);
    }

    $("#modal-remove-facilitator-roles-confirm").click(function(e) {
        e.preventDefault();
        $('#modal-remove-facilitator-roles').modal('hide');
        $("#userprofile-enable_facilitator_box").val("0");
        facilitatorRoleStatus(false);
        $("#facilitator-flash-messages-container").append("<div id=\"flash-facilitator-roles-removed\" class=\"alert-success alert fade\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>{$facilitatorRolesRemovesMessage}</div>");
        setTimeout(function() {
          $("#flash-facilitator-roles-removed").addClass("in");
        }, 500);
    });
    
    $("#disable-facilitator-button").click(function(e) {
        e.preventDefault();
        let modal = $('#modal-remove-facilitator-roles').modal('show');
        modal.find('.modal-body').load($('.modal-dialog'));
    });
    
    $("#enable-facilitator-button").click(function(e) {
        e.preventDefault();
        $("#userprofile-enable_facilitator_box").val("1");
        facilitatorRoleStatus(true);
        $("#s2-togall-selected-facilitator-roles").click();
    });
JS
    );
}

$activeFacilitatorRoles = \arter\amos\admin\utility\UserProfileUtility::getFacilitatorForModuleRoles();
$facilitatorRolesAssignedToUser = \arter\amos\admin\utility\UserProfileUtility::getFacilitatorRolesForUser($model->user_id, $activeFacilitatorRoles);

if (count($activeFacilitatorRoles) == 1) {
    $this->registerJs(<<<JS
        $(document).ready(function() {
            $("#enabled-facilitator-roles-box span").addClass("disabled-field");
        });
JS
    );
}

?>

<section>
    <?php if($model->isNewRecord) : ?>
    <div class="col-xs-12 nop">
        <div class="form-group">
            <label class="control-label">
                <?= \arter\amos\admin\AmosAdmin::t('amosadmin', 'Utente facilitatore') ?>
            </label>
            <p><?php \arter\amos\admin\AmosAdmin::t('amosadmin', '#facilitator_role_box_isnewrecord_warning'); ?></p>
        </div>
    </div>
    <?php else : ?>
    <div class="col-xs-12 nop">

        <div class="form-group">
            <label class="control-label">
                <?= \arter\amos\admin\AmosAdmin::t('amosadmin', 'Utente facilitatore') ?>
            </label>

            <?= \yii\helpers\Html::button('Abilita', [
                'class' => 'btn btn-navigation-primary facilitator-roles-enabled',
                'id' => 'enable-facilitator-button',
            ]); ?>

            <?= \yii\helpers\Html::button('Disabilita', [
                'class' => 'btn btn-danger facilitator-roles-disabled',
                'id' => 'disable-facilitator-button',
            ]); ?>

            <?= $form->field($model, 'enable_facilitator_box')->hiddenInput()->label(false); ?>
        </div>

        <div id="facilitator-flash-messages-container"></div>

        <div id="enabled-facilitator-roles-box" class="form-group facilitator-roles-disabled">
            <?php
                    // Inserted above
//            $activeFacilitatorRoles = \arter\amos\admin\utility\UserProfileUtility::getFacilitatorForModuleRoles();
//            $facilitatorRolesAssignedToUser = \arter\amos\admin\utility\UserProfileUtility::getFacilitatorRolesForUser($model->user_id, $activeFacilitatorRoles);
            //pr($activeFacilitatorRoles, 'facilitator for module roles in user-profile/_form');
            //pr($facilitatorRolesAssignedToUser, 'facilitator roles assigned to user in user-profile/_form');
            ?>

            <label class="control-label">
                <?= \arter\amos\admin\AmosAdmin::t('amosadmin', 'Ruoli facilitatore abilitati') ?>
            </label>

            <?= \arter\amos\core\forms\editors\Select::widget([
                'name' => 'selectedFacilitatorRoles',
                'data' => $activeFacilitatorRoles,
                'value' => !empty($selectedFacilitatorRoles) ? $selectedFacilitatorRoles : $facilitatorRolesAssignedToUser,
                'options' => [
                    'multiple' => true,
                ],
                'class' => 'form-control',
                'id' => 'selected-facilitator-roles',
            ]);
            ?>
        </div>
    </div>
    <?php
        \yii\bootstrap\Modal::begin([
            'header' => '<h4 class="modal-title">Rimozione ruolo facilitatore</h4>',
            'id' => 'modal-remove-facilitator-roles',
            'footer' => \yii\helpers\Html::button("Annulla", ["class" => "btn btn-secondary", "id" => 'modal-remove-facilitator-roles-cancel', 'data' => ['dismiss' => "modal"]]) . " " . \yii\helpers\Html::button("Si", ["class" => "btn btn-navigation-primary", "id" => 'modal-remove-facilitator-roles-confirm']),
        ])
    ?>
        <h4><?= \arter\amos\admin\AmosAdmin::t('amosadmin', 'Stai togliendo all\'utente il ruolo di facilitatore, confermi?') ?></h4>
    <?php
        \yii\bootstrap\Modal::end();
    ?>
    <?php endif; ?>
</section>
