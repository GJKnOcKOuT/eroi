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

use \arter\amos\een\AmosEen;
use arter\amos\core\helpers\Html;
use arter\amos\core\forms\ActiveForm;
use arter\amos\admin\AmosAdmin;
use kartik\datecontrol\DateControl;
use arter\amos\core\forms\Tabs;
use arter\amos\core\forms\CloseSaveButtonWidget;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var \arter\amos\een\models\EenExprOfInterest $model
 * @var \arter\amos\een\models\EenPartnershipProposal $modelEenPartenership
 * @var yii\widgets\ActiveForm $form
 */

$js = <<< JS
    showHideForm2($("#area-id"));
    $("#area-id").on("select2:select", function(){
        showHideForm2(this);
    });
    
     $("#company-organization-id").on("select2:select", function(){
        $.ajax({
           url: 'get-organization-selected-ajax',
           type: 'get',
           data: {
                     id: $(this).val()
                 },
           success: function (data) {
              $.each(data, function(key, value){
                 setValuesOrganization(key, value);
              });
           }
        });
    });
     
     $("#other-organization").click(function(){
         if($(this).is( ":checked" )){
               $('#container-company-organization-id').hide();
               $('#container-company-organization-name').show();
               $('#container-company-organization-name input').removeAttr('disabled');
               $('#container-company-organization-id select').attr('disabled', true);
               $('.org-to-clear input').val('');
         }
         else {
             $('#container-company-organization-id').show();
             $('#container-company-organization-name').hide();
             $('#container-company-organization-name input').attr('disabled', true);
             $('#container-company-organization-id select').removeAttr('disabled');

         }
     });
     
     /** set the value and the property readonly */
     function setValuesOrganization(key, value){
         if($('#company-organization-id').length > 0) {
              $('#eenexprofinterest-'+key)
                  .val(value)
         }
     }
    
    function showHideForm2(elem){
       $("#contact-een-div").show();
        if($(elem).val() == 1){
            $("#second-part-form").show();
        }
        else {
           // $("#second-part-form").hide();
        }
    }
    
    $('#contact-een-id').on('depdrop:afterChange', function(event){
        if($('#contact-een-id option').length > 1){
            $("#contact-een-div").show();
        }
        else {
            $("#contact-een-div").hide(); 
        }
    });
JS;
$this->registerCss("input[readonly] {
    background-color: #eee !important;
}");

$this->registerJs($js);
if($model->is_request_more_info) {
    $this->title = AmosEen::t('amoseen','#expr_of_interest_request_more_info');
}
else {
    $this->title = AmosEen::t('amoseen','#expr_of_interest_for_profile');
}
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="een-expr-of-interest-form col-xs-12 nop">
    <?php $form = ActiveForm::begin();
    echo $form->errorSummary($model,['class' => 'alert alert-danger'])
    ?>

    <?= \arter\amos\core\forms\WorkflowTransitionWidget::widget([
        'form' => $form,
        'model' => $model,
        'workflowId' => \arter\amos\een\models\EenExprOfInterest::EEN_EXPR_OF_INTEREST_WORKFLOW,
        'classDivIcon' => 'pull-left',
        'classDivMessage' => 'pull-left message',
        'viewWidgetOnNewRecord' => true
    ]); ?>

    <div class="col-xs-12 nop">
        <h2><?= $modelEenPartenership->content_title ?></h2>
        <i><?= AmosEen::t('amoseen','#code_proposal_partnership:') . ' ' . $modelEenPartenership->reference_external ?></i>
        <?php if($model->is_request_more_info == 1){ ?>
            <p><?= AmosEen::t('amoseen','#subtitle_request_info')?></p>
        <?php  } else { ?>
            <p><?= AmosEen::t('amoseen','#subtitle_expr_of_interest')?></p>
        <?php  } ?>
    </div>
    <br>
    <div class="col-xs-6 box-een m-t-30 m-b-30" style="border:solid 1px">
        <div class="row">
            <div class="col-lg-12">
                <i><?= AmosEen::t('amoseen','#enter_profile') . ' ' .  Html::a(AmosEen::t('amoseen','#profile_card'), ['/admin/user-profile/update', 'id' => $model->user->userProfile->id])?></i>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <strong>Nome e cognome</strong>
            </div>
            <div class="col-lg-8">
                <?= $model->user->userProfile->getNomeCognome()?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <strong>E-mail</strong>
            </div>
            <div class="col-lg-8">
                <?= $model->user->email?>
            </div>
        </div>
    </div>

<!--    --><?php //if(\Yii::$app->user->can('STAFF_EEN')){ ?>
<!--        <div  class="col-xs-6">-->
<!--            --><?php //echo $form->field($model, 'sub_status')->widget(Select2::className(),[
//                'data' => $model->getAvaiableSubStatus(),
//                'options' => [
//                    'placeholder' => AmosEen::t('amoseen','Select...')],
//                'pluginOptions' => [
//                    'allowClear' => true,
//                ]
//            ])?>
<!--        </div>-->
<!--    --><?php //} ?>

    <?php
    echo $form->field($model, 'een_partnership_proposal_id')->hiddenInput()->label(false);
    echo $form->field($model, 'is_request_more_info')->hiddenInput(['id' => 'request-more-info-id', 'value' => $model->is_request_more_info])->label(false);
    ?>

    <div class="row">
        <div class="col-lg-6 col-sm-6">
            <?= $form->field($model, 'een_network_node_id')->widget(Select2::className(),[
                'data' => ArrayHelper::map(\arter\amos\een\models\EenNetworkNode::find()->all(),'id', 'name'),
                'options' => [
                        'id' => 'area-id',
                        'placeholder' => AmosEen::t('amoseen','Select...')],
                'pluginOptions' => [
                    'allowClear' => true,
                ]
            ])->label(AmosEen::t('amoseen', "#label_region"));?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-sm-6">
            <?= $form->field($model, 'know_een')->inline(true)
                ->radioList(['1' => AmosEen::t('amoseen', 'Si'), '0' => AmosEen::t('amoseen', 'No')], [])
            ->label(AmosEen::t('amoseen', '#description_know_een3'),
                ['class' => 'no-asterisk control-label'])?>
        </div>
    </div>


    <div class="row" style="display:none" id="contact-een-div">
<!--        <div class="col-lg-6 col-sm-6">
            <?php echo $form->field($model, 'een_staff_id')->widget(\kartik\depdrop\DepDrop::className(),[
                'data' => !empty($model->een_staff_id) ? [$model->een_staff_id => \arter\amos\een\models\EenStaff::findOne($model->een_staff_id)] : [],
                'options' => ['id' => 'contact-een-id'],
                'pluginEvents'=> [
                ],
                'pluginOptions'=>[
                    'depends'=> ['area-id'],
                    'placeholder'=>  AmosEen::t('amoseen','Select...'),
                    'url'=> Url::to(['/een/een-expr-of-interest/staff-by-area']),
                    'initialize' => true,

                ]
            ])->label(AmosEen::t('amoseen', "#choose_contact_een1")); ?>
        </div>-->
    </div>
<div class="row">
    <div class="col-lg-6">
        <label><?= AmosEen::t('amoseen', 'La tua manifestazione d???interesse sar?? presa in carico dallo staff Enterprise Europe Network di ART-ER') ?></label>
    </div>
</div>

    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <?= $form->field($model, 'note')->textarea([
                'rows' => 5,
                'maxlength' => 600,
                'placeholder' => AmosEen::t('amoseen', 'You can enter max 600 characters')
            ])->label(AmosEen::t('amoseen', 'Eventuali osservazioni'))?>
        </div>
    </div>
    <hr>


        <div id="second-part-form">
            <?php if($model->is_request_more_info == false) {
                $readonly = false; ?>
            <h3><?= AmosEen::t('amoseen', "Ti chiediamo di rispondere in inglese alle seguenti domande")?></h3>
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <?php $organizations = \arter\amos\een\utility\EenUtility::userOrganizationNetwork();
                    if(!empty($organizations) && $model->org_name_inserted_manually == 0) {
                        if(!empty($model->company_organization)){
                            foreach ($organizations as $org){
                                if($model->company_organization == $org->name){
                                    $model->company_organization = $org->id;
                                }
                            }
                        }?>
                        <div id="container-company-organization-id">
                        <?= $form->field($model, 'company_organization')->widget(Select2::className(),[
                            'data' => ArrayHelper::map(\arter\amos\een\utility\EenUtility::userOrganizationNetwork(), 'id', 'name'),
                            'options' => [
                                'id' => 'company-organization-id',
                                'placeholder' => AmosEen::t('amoseen','Select...'),
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                            ]
                        ])->label(AmosEen::t('amoseen', 'Company Organization1')); ?>
                        </div>
                        <?php // if inserted manually is == 1 is shown only a inmput text?>
                        <?= $form->field($model, 'org_name_inserted_manually')->checkbox(['id' => 'other-organization'])->label(AmosEen::t('amoseen','Organization not present in the list')) ?>
                        <div id="container-company-organization-name" hidden>
                            <?= $form->field($model, 'company_organization')->textInput(['maxlength' => true, 'disabled' => true , 'id' => 'company_organization2'])
                            ->label(AmosEen::t('amoseen', 'Company Organization1'))?>
                        </div>
                    <?php } else { ?>
                        <?= $form->field($model, 'company_organization')->textInput(['maxlength' => true,'id' => 'company_organization'])
                        ->label(AmosEen::t('amoseen', 'Company Organization1'))?>
                        <div hidden>
                        <?= $form->field($model, 'org_name_inserted_manually')->hiddenInput(['value' => 1])?></div>

                    <?php }?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-sm-6">

                    <?= $form->field($model, 'sector')->textInput(['maxlength' => true, 'id' => 'sector'])->label(AmosEen::t('amoseen', 'Sector/Activities1')) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-sm-6 org-to-clear">
                    <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'readonly' => $readonly,'id' => 'address'])
                        ->label(AmosEen::t('amoseen', 'Address1')) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-sm-6 org-to-clear">
                    <?= $form->field($model, 'city')->textInput(['maxlength' => true, 'readonly' => $readonly, 'id' => 'city'])
                        ->label(AmosEen::t('amoseen', 'City1'))?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-sm-6 org-to-clear">
                    <?= $form->field($model, 'postal_code')->textInput(['maxlength' => true, 'readonly' => $readonly, 'id' => 'postal_code'])
                        ->label(AmosEen::t('amoseen', 'Postal code1'))?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-sm-6 org-to-clear">
                    <?= $form->field($model, 'web_site')->textInput(['maxlength' => true, 'id' => 'web_site'])
                        ->label(AmosEen::t('amoseen', 'Web site1'))?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <?= $form->field($model, 'contact_person')->textInput(['maxlength' => true, 'readonly' => true, 'id' => 'contact_person'])
                        ->label(AmosEen::t('amoseen', 'Contact person1'))?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'id' => 'phone'])
                        ->label(AmosEen::t('amoseen', 'Phone1'))?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'readonly' => true, 'id' => 'email'])
                        ->label(AmosEen::t('amoseen', 'Email'))?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <?= $form->field($model, 'technology_interest')->textarea([
                            'rows' => 5, 'maxlength' => 600,
                        'placeholder' => AmosEen::t('amoseen', 'You can enter max 600 characters'), 'id' => 'technology_interest'
                    ])
                    ->label(AmosEen::t('amoseen', 'What kind of cooperation are you looking for?'));?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <?= $form->field($model, 'information_request')->textarea([
                            'rows' => 5,'maxlength' => 600,
                        'placeholder' => AmosEen::t('amoseen', 'You can enter max 600 characters'), 'id' => 'information_request'

                    ])
                        ->label(AmosEen::t('amoseen', 'Which information is missing or unclear?'));?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <?= $form->field($model, 'organization_presentation')->textarea([
                         'rows' => 5, 'maxlength' => 600,
                        'placeholder' => AmosEen::t('amoseen', 'You can enter max 600 characters'), 'id' => 'organization_presentation'
                    ])
                        ->label(AmosEen::t('amoseen', 'Some facts about your company'))?>
                </div>
            </div>
            <hr>

            <?php } ?>

        </div>

    <div class="col-lg-12 m-t-20">
        <p  style="text-align: center">
<!--            < ?= AmosEen::t('amoseen', '#privacy_een')?>-->
        </p>
    </div>
    <!--            <div class="col-lg-12">-->
    <!--                <p>-->
    <!--                    --><?php //echo AmosEen::t('amoseen', '#information_text') ?>
    <!--                </p>-->
    <!--            </div>-->
    <!--            <hr>-->
    <!--            <div class="col-lg-12">-->
    <!--                <p>-->
    <!--                    --><?php //echo AmosEen::t('amoseen', '#information_text1') ?>
    <!--                </p>-->
    <!--                <p class="text-center">-->
    <!--                    --><?php //echo AmosEen::t('amoseen', '#information_text2') ?>
    <!--                </p>-->
    <!--                <p>-->
    <!--                    --><?php //echo AmosEen::t('amoseen', '#information_text3') ?>
    <!--                </p>-->
    <!--            </div>-->
    <!--            <div class="col-lg-12 m-t-20">-->
    <!--                <p>-->
    <!--                    --><?php //echo AmosEen::t('amoseen', '#information_text4') ?>
    <!--                </p>-->
    <!--            </div>-->
<!--    <div class="col-lg-12 col-sm-12">-->
<!--        < ?= //$form->field($model, 'privacy')->checkbox(['id' => 'privacy-expr'])->label(AmosEen::t('amoseen', '#privacy_label1')."<span class='text-danger'>*</span>"); ?>-->
<!--    </div>-->
<!--    < ?= //Html::a(AmosAdmin::t('amosadmin', '#cookie_policy_message'), '/site/privacy', ['title' => AmosAdmin::t('amosadmin', '#cookie_policy_title'), 'target' => '_blank']) ?>-->
<!--    < ?=// Html::tag('p', AmosAdmin::t('amosadmin', '#cookie_policy_content')) ?>-->
    <?= $form->field($model, 'privacy')->radioList([
        1 => AmosAdmin::t('amosadmin', '#cookie_policy_ok'),
    ])->label(Html::a(AmosEen::t('amoseen', 'Prendi visione delle modalit?? operative dello svolgimento del servizio e accetta per continuare'), '/site/modalitaoperativeeen', ['title' => AmosEen::t('amoseen', '#privacy_label_1'), 'target' => '_blank'])); ?>

    <?= CloseSaveButtonWidget::widget(['model' => $model, 'buttonNewSaveLabel' => AmosEen::t('amoseen', '#send')]); ?>
    <?php ActiveForm::end(); ?>
</div>
