<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\amos\admin\views\user-profile\boxes
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;


$this->registerCss(<<<CSS
    .flexed-section > .col-xs-12 > .form-group{
     display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    }

CSS
);

if (!$model->isNewRecord) {
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

    .animator-roles-enabled,
     .animator-roles-disabled {
        display: none;
    }

    .cm-roles-enabled,
     .cm-roles-disabled {
        display: none;
    }
CSS
    );

    $facilitatorRolesRemovesMessage = \arter\amos\admin\AmosAdmin::t('amosadmin', '#facilitator_roles_removed');
    $facilitatorRolesAssignedMessage = \arter\amos\admin\AmosAdmin::t('amosadmin', '#facilitator_roles_assigned');

    $animatorRolesRemovesMessage = \arter\amos\admin\AmosAdmin::t('amosadmin', '#animator_roles_removed');
    $animatorRolesAssignedMessage = \arter\amos\admin\AmosAdmin::t('amosadmin', '#animator_roles_assigned');

    $cmRolesRemovesMessage = \arter\amos\admin\AmosAdmin::t('amosadmin', '#cm_roles_removed');
    $cmRolesAssignedMessage = \arter\amos\admin\AmosAdmin::t('amosadmin', '#cm_roles_assigned');

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
        $("#facilitator-role").append("<input type=\"hidden\" id=\"selectedFacilitatorRoles\" name=\"selectedFacilitatorRoles[]\" value=\"FACILITATOR\">");
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
        
        $("#facilitator-role").append("<input type=\"hidden\" id=\"selectedFacilitatorRoles\" name=\"selectedFacilitatorRoles[]\" value=\"FACILITATOR\">");
        facilitatorRoleStatus(true);
    });
                
    function animatorRoleStatus(enabled) {
        if(enabled) {
            $(".animator-roles-disabled").removeClass("animator-roles-disabled");
            $("#enable-animator-button").addClass("animator-roles-enabled");
        } else {
            $(".animator-roles-enabled").removeClass("animator-roles-enabled");
            $("#disable-animator-button").addClass("animator-roles-disabled");
        }
    }
		
    if($("#enable_animator_box").val() == 1) {

        animatorRoleStatus(true);
    } else if($("#enable_animator_box").val() == 0){

        animatorRoleStatus(false);
    }

    $("#modal-remove-animator-roles-confirm").click(function(e) {
        e.preventDefault();
        $('#modal-remove-animator-roles').modal('hide');
        $("#enable_animator_box").val(0);
        animatorRoleStatus(false);
        $("#animator-flash-messages-container").append("<div id=\"flash-animator-roles-removed\" class=\"alert-success alert fade\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>{$animatorRolesRemovesMessage}</div>");
        setTimeout(function() {
          $("#flash-animator-roles-removed").addClass("in");
        }, 500);
    });
    
    $("#disable-animator-button").click(function(e) {
        e.preventDefault();
        let modal = $('#modal-remove-animator-roles').modal('show');
        modal.find('.modal-body').load($('.modal-dialog'));
    });
    
    $("#enable-animator-button").click(function(e) {
        e.preventDefault();
        $("#enable_animator_box").val(1);
        animatorRoleStatus(true);

    });
                
    function cmRoleStatus(enabled) {
        if(enabled) {
            $(".cm-roles-disabled").removeClass("cm-roles-disabled");
            $("#enable-cm-button").addClass("cm-roles-enabled");
        } else {
            $(".cm-roles-enabled").removeClass("cm-roles-enabled");
            $("#disable-cm-button").addClass("cm-roles-disabled");
        }
    }

    if($("#enable_cm_box").val() == 1) {
        cmRoleStatus(true);
    } else if($("#enable_cm_box").val() == 0){
        cmRoleStatus(false);
    }
	
    $("#modal-remove-cm-roles-confirm").click(function(e) {
        e.preventDefault();
        $('#modal-remove-cm-roles').modal('hide');
        $("#enable_cm_box").val(0);
        cmRoleStatus(false);
        $("#cm-flash-messages-container").append("<div id=\"flash-cm-roles-removed\" class=\"alert-success alert fade\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>{$cmRolesRemovesMessage}</div>");
        setTimeout(function() {
          $("#flash-cm-roles-removed").addClass("in");
        }, 500);
    });
    
    $("#disable-cm-button").click(function(e) {
        e.preventDefault();
        let modal = $('#modal-remove-cm-roles').modal('show');
        modal.find('.modal-body').load($('.modal-dialog'));
    });
    
    $("#enable-cm-button").click(function(e) {
        e.preventDefault();
        $("#enable_cm_box").val(1);
        cmRoleStatus(true);

    });
JS
    );
}


$activeFacilitatorRoles = \arter\amos\admin\utility\UserProfileUtility::getFacilitatorForModuleRoles();

if (count($activeFacilitatorRoles) == 1) {
    $this->registerJs(<<<JS
        $(document).ready(function() {
            $("#enabled-facilitator-roles-box span").addClass("disabled-field");
        });
JS
    );
}

$canAnimator = \Yii::$app->authManager->checkAccess($model->user_id, 'PARTNER_PROF_EXPR_OF_INT_ADMIN_FACILITATOR');
$canCm = \Yii::$app->authManager->checkAccess($model->user_id, 'CM_SFIDE');

?>

<section class="flexed-section">
    <?php if ($model->isNewRecord) : ?>
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

            <div id="facilitator-role" class="form-group">

                <label class="control-label">
                    <?= \arter\amos\admin\AmosAdmin::t('amosadmin', 'Utente facilitatore') ?>
                </label>

                <?=
                \yii\helpers\Html::button('Abilita', [
                    'class' => 'btn btn-navigation-primary facilitator-roles-enabled',
                    'id' => 'enable-facilitator-button',
                ]);
                ?>

                <?=
                \yii\helpers\Html::button('Disabilita', [
                    'class' => 'btn btn-danger facilitator-roles-disabled',
                    'id' => 'disable-facilitator-button',
                ]);
                ?>

            </div>

            <div id="facilitator-flash-messages-container"></div>

            <div id="enabled-facilitator-roles-box" class="form-group facilitator-roles-disabled">

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

        <?= $form->field($model, 'enable_facilitator_box')->hiddenInput()->label(false); ?>
        

</section>

<section class="flexed-section">
    <?php if ($model->isNewRecord) : ?>
        <div class="col-xs-12 nop">
            <div class="form-group">

                <label class="control-label">
                    <?= \arter\amos\admin\AmosAdmin::t('amosadmin', 'Utente animatore') ?>
                </label>

                <p><?php \arter\amos\admin\AmosAdmin::t('amosadmin', '#animator_role_box_isnewrecord_warning'); ?></p>
            </div>
        </div>
    <?php else : ?>
        <div class="col-xs-12 nop">

            <div class="form-group">

                <label class="control-label">
                    <?= \arter\amos\admin\AmosAdmin::t('amosadmin', 'Utente animatore') ?>
                </label>


                <?=
                \yii\helpers\Html::button('Abilita', [
                    'class' => $canAnimator ? 'btn btn-navigation-primary animator-roles-disabled' : 'btn btn-navigation-primary ',
                    'id' => 'enable-animator-button',
                ]);
                ?>

                <?=
                \yii\helpers\Html::button('Disabilita', [
                    'class' => !$canAnimator ? 'btn btn-danger animator-roles-disabled' : 'btn btn-danger ',
                    'id' => 'disable-animator-button',
                ]);
                ?>

                <?= Html::hiddenInput('enable_animator_box', $canAnimator , ['id' => 'enable_animator_box']); ?>
            </div>

            <div id="animator-flash-messages-container"></div>


        </div>
        <?php
        \yii\bootstrap\Modal::begin([
            'header' => '<h4 class="modal-title">Rimozione ruolo animatore</h4>',
            'id' => 'modal-remove-animator-roles',
            'footer' => \yii\helpers\Html::button("Annulla", ["class" => "btn btn-secondary", "id" => 'modal-remove-animator-roles-cancel', 'data' => ['dismiss' => "modal"]]) . " " . \yii\helpers\Html::button("Si", ["class" => "btn btn-navigation-primary", "id" => 'modal-remove-animator-roles-confirm']),
        ])
        ?>
        <h4><?= \arter\amos\admin\AmosAdmin::t('amosadmin', 'Stai togliendo all\'utente il ruolo di animatore, confermi?') ?></h4>
        <?php
        \yii\bootstrap\Modal::end();
        ?>
    <?php endif; ?>

</section>

<section class="flexed-section">
    <?php if ($model->isNewRecord) : ?>
        <div class="col-xs-12 nop">
            <div class="form-group">
                <label class="control-label">
                    <?= \arter\amos\admin\AmosAdmin::t('amosadmin', 'Utente Community Manager') ?>
                </label>
                <p><?php \arter\amos\admin\AmosAdmin::t('amosadmin', '#cm_role_box_isnewrecord_warning'); ?></p>

            </div>
        </div>
    <?php else : ?>
        <div class="col-xs-12 nop">

            <div class="form-group">
                <label class="control-label">
                    <?= \arter\amos\admin\AmosAdmin::t('amosadmin', 'Utente Community Manager') ?>
                </label>

                <?=
                \yii\helpers\Html::button('Abilita', [
                    'class' => $canCm ? 'btn btn-navigation-primary cm-roles-disabled' : 'btn btn-navigation-primary ',
                    'id' => 'enable-cm-button',
                ]);
                ?>

                <?=
                \yii\helpers\Html::button('Disabilita', [
                    'class' => !$canCm ? 'btn btn-danger cm-roles-disabled' : 'btn btn-danger ',
                    'id' => 'disable-cm-button',
                ]);
                ?>


                <?= Html::hiddenInput('enable_cm_box', $canCm, ['id' => 'enable_cm_box']); ?>
            </div>

            <div id="cm-flash-messages-container"></div>


        </div>
        <?php
        \yii\bootstrap\Modal::begin([
            'header' => '<h4 class="modal-title">Rimozione ruolo cme</h4>',
            'id' => 'modal-remove-cm-roles',
            'footer' => \yii\helpers\Html::button("Annulla", ["class" => "btn btn-secondary", "id" => 'modal-remove-cm-roles-cancel', 'data' => ['dismiss' => "modal"]]) . " " . \yii\helpers\Html::button("Si", ["class" => "btn btn-navigation-primary", "id" => 'modal-remove-cm-roles-confirm']),
        ])
        ?>
        <h4><?= \arter\amos\admin\AmosAdmin::t('amosadmin', 'Stai togliendo all\'utente il ruolo di Community Manager, confermi?') ?></h4>
        <?php
        \yii\bootstrap\Modal::end();
        ?>
    <?php endif; ?>

</section>


