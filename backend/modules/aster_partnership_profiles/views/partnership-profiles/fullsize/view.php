<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_partnership_profiles\views\partnership-profiles\fullsize
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use backend\modules\aster_partnership_profiles\controllers\PartnershipProfilesController;
use backend\modules\aster_partnership_profiles\models\PartnershipProfiles;
use backend\modules\aster_partnership_profiles\utility\PartnershipProfilesUtility;
use arter\amos\attachments\components\AttachmentsTableWithPreview;
use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\ContextMenuWidget;
use arter\amos\core\forms\ItemAndCardHeaderWidget;
use arter\amos\core\forms\PublishedByWidget;
use arter\amos\core\forms\ShowUserTagsWidget;
use arter\amos\core\forms\Tabs;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\views\AmosGridView;
use arter\amos\core\views\toolbars\StatsToolbar;
use arter\amos\partnershipprofiles\Module;
use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var arter\amos\partnershipprofiles\models\PartnershipProfiles $model
 */

$this->title = strip_tags($model);
$this->params['breadcrumbs'][] = ['label' => Module::t('amospartnershipprofiles', 'Partnership Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$statesCounter = $model->getExpressionsOfInterestStatesCounter();

/** @var PartnershipProfilesController $appController */
$appController = Yii::$app->controller;
$sfide_community_id = 'false';
$sfide_community_id = $model->sfide_community_id != null ? 'true' : 'false';

$ownInterestPartnershipProfileIds = $appController->getOwnInterestPartnershipProfiles(true);

// Tab ids
$idTabCard = 'tab-card';
$idClassifications = 'tab-classifications';
$idTabMoreInformation = 'tab-more-information';
$idTabAttachments = 'tab-attachments';
$idTabAnimator = 'tab-animatore';

$moreInformationLinkId = "more-information-link-id";
$moreInformationBlockId = "more-information-block-id";
$lessInformationLinkId = "less-information-block-id";

$js = "
$('#" . $moreInformationLinkId . "').on('click', function (event) {
    event.preventDefault();
    $(this).addClass('hidden');
    $('#" . $moreInformationBlockId . "').removeClass('hidden');
    $('#" . $lessInformationLinkId . "').removeClass('hidden');
    return false;
});
$('#" . $lessInformationLinkId . "').on('click', function (event) {
    event.preventDefault();
    $(this).addClass('hidden');
    $('#" . $moreInformationBlockId . "').addClass('hidden');
    $('#" . $moreInformationLinkId . "').removeClass('hidden');
    return false;
});
";
$this->registerJs($js, View::POS_READY);

$module = \Yii::$app->getModule('partnershipprofiles');
$moduleCwh = \Yii::$app->getModule('cwh');
$communityConfigurationsId = null;
if (isset($moduleCwh) && !empty($moduleCwh->getCwhScope())) {
    $scope = $moduleCwh->getCwhScope();
    if (isset($scope['community'])) {
        $communityConfigurationsId = 'communityId-' . $scope['community'];
    }
}

$enabledFields = !empty($module->fieldsCommunityConfigurations[$communityConfigurationsId]['fields']) ? $module->fieldsCommunityConfigurations[$communityConfigurationsId]['fields'] : (!empty($module->fieldsConfigurations['fields']) ? $module->fieldsConfigurations['fields'] : []);
$enabledTabs = !empty($module->fieldsCommunityConfigurations[$communityConfigurationsId]['tabs']) ? $module->fieldsCommunityConfigurations[$communityConfigurationsId]['tabs'] : (!empty($module->fieldsConfigurations['tabs']) ? $module->fieldsConfigurations['tabs'] : []);

$this->registerJs(<<<JS
    function communityExists(enabled) {
        if(enabled) {
            $(".community-create").removeClass("create-access");
            $("#create-community-button").addClass("community-create");
        } else {
            $(".community-create").removeClass("community-create");
            $("#access-community-button").addClass("community-access");
        }
    }

    if( $sfide_community_id === 'true') {
        communityExists(true);
    } else {
        communityExists(false);
    }

    $("#modal-create-community-confirm").click(function(e) {
        e.preventDefault();
        $('#modal-create-community').modal('hide');
        $("#create-community-box-id").val("1"); 
        setTimeout(function() {
          $("#flash-community-create").addClass("in");
        }, 500);
    });
    
    $("#create-community-button").click(function(e) {
        e.preventDefault();
        $("#create-community-box-id").val("0");
         communityExists(true);
        let modal = $('#modal-create-community').modal('show');
        modal.find('.modal-body').load($('.modal-dialog'));
    });
    

JS
    , View::POS_READY);

?>


<div class="<?= Yii::$app->controller->id ?>-view post-details col-xs-12 nop">

    <?php $this->beginBlock($idTabCard); ?>

    <div class="post-header col-xs-12 col-sm-7 nop media">
        <?= ItemAndCardHeaderWidget::widget([
            'model' => $model,
            'publicationDateField' => 'created_at'
        ]); ?>
    </div>

    <div class="col-sm-7 col-xs-12 nop">
        <div class="post-content col-xs-12 nop">
            <div class="post-title col-xs-10">
                <h2><?= $model->title ?></h2>
            </div>
            <?= ContextMenuWidget::widget([
                'model' => $model,
                'actionModify' => "/partnershipprofiles/partnership-profiles/update?id=" . $model->id,
                'actionDelete' => "/partnershipprofiles/partnership-profiles/delete?id=" . $model->id
            ]) ?>
            <div class="clearfix"></div>
            <div class="row nom post-wrap">
                <div class="post-text col-xs-12">
                    <?= $model->short_description ?>
                    <!--<p><?= $model->expected_contribution ?></p>-->
                    <!--<p><?= $model->extended_description ?></p>-->
                </div>
            </div>
        </div>
        <div class="post-footer col-xs-12 nop">
            <div class="post-info col-xs-12">
                <?php if (!empty($enabledFields['expiration_in_months']) && $enabledFields['expiration_in_months'] == true) {
                    $pubblicationDate = '{pubblicationdates}';
                } else {
                    $pubblicationDate = '{pubblishedfrom}';
                }
                ?>
                <?= PublishedByWidget::widget([
                    'model' => $model,
                    'layout' => '{publisherAdv}{targetAdv}{animator}{statusTranslated}' . $pubblicationDate,
                    'renderSections' => [
                        '{statusTranslated}' => function ($model) {
                            return Html::tag('label', \arter\amos\core\module\BaseAmosModule::t('amoscore', 'Status')) . ': ' .
                                Module::t('amospartnershipprofiles', $model->getWorkflowStatus()->label);
                        },
                        '{animator}' => function ($model) {
                            return Html::tag('label', Module::t('amospartnershipprofiles', '#Animatore')) . ': ' . $model->partnershipProfileFacilitator->nomeCognome . Html::endTag('br');
                        }
                    ]
                ]) ?>
            </div>
            <?php if (isset($statsToolbar) && $statsToolbar): ?>
                <?= StatsToolbar::widget(['model' => $model]); ?>
            <?php endif; ?>
        </div>
    </div>

    <?php
    $sidebarParams = [
        'model' => $model,
        'ownInterestPartnershipProfileIds' => $ownInterestPartnershipProfileIds,
    ];
    ?>
    <?= $this->render('boxes/sidebar', $sidebarParams) ?>

    <div class="container-general-info col-xs-12 nop">
        <!--<?= Html::a(Module::t('amospartnershipprofiles', 'Show more information'), '', ['class' => 'more-info', 'id' => $moreInformationLinkId]); ?>
        <?= Html::a(Module::t('amospartnershipprofiles', 'Show less information'), '', ['class' => 'more-info hidden', 'id' => $lessInformationLinkId]); ?>-->
        <div id="<?= $moreInformationBlockId ?>"><!--class="hidden"-->
            <h3 class="title"><?= AmosIcons::show('info-outline'); ?> <?= Module::tHtml('amospartnershipprofiles', 'Information') ?></h3>
            <?php
            $attributes = [];
            if (!empty($enabledFields['title']) && $enabledFields['title'] == true) {
                $attributes[] = 'title';
            }
            $attributes['status'] = [
                'attribute' => 'status',
                'label' => $model->getAttributeLabel('status'),
                'value' => Module::t('amospartnershipprofiles', $model->getWorkflowStatus()->getLabel()),
            ];


            if (!empty($enabledFields['extended_description']) && $enabledFields['extended_description'] == true) {
                $attributes[] = 'extended_description:raw';
            }
            if (!empty($enabledFields['expected_contribution']) && $enabledFields['expected_contribution'] == true) {
                $attributes[] = 'expected_contribution:raw';
            }
            if (!empty($enabledFields['advantages_innovative_aspects']) && $enabledFields['advantages_innovative_aspects'] == true) {
                $attributes[] = 'advantages_innovative_aspects:raw';
            }
            if (!empty($enabledFields['contact_person']) && $enabledFields['contact_person'] == true) {
                $attributes[] = 'contact_person';
            }
            if (!empty($enabledFields['other_prospect_desired_collab']) && $enabledFields['other_prospect_desired_collab'] == true) {
                $attributes[] = 'other_prospect_desired_collab';
            }
            if (!empty($enabledFields['partnership_profile_date']) && $enabledFields['partnership_profile_date'] == true) {
                $attributes[] = 'partnership_profile_date:date';
            }
            if (!empty($enabledFields['expiration_in_months']) && $enabledFields['expiration_in_months'] == true) {
                $attributes[] = 'expiration_in_months';
                $attributes[] = [
                    'label' => Module::t('amospartnershipprofiles', 'Calculated Expiry Date'),
                    'value' => function ($model) {
                        /** @var PartnershipProfiles $model */
                        return PartnershipProfilesUtility::calcExpiryDateStr($model, true);
                    }
                ];
            }


            if (!empty($enabledTabs['tab-more-information']) && $enabledTabs['tab-more-information'] == true) {
                if (!empty($enabledFields['english_title']) && $enabledFields['english_title'] == true) {
                    $attributes[] = 'english_title';
                }
                if (!empty($enabledFields['english_short_description']) && $enabledFields['english_short_description'] == true) {
                    $attributes[] = 'english_short_description:html';
                }
                if (!empty($enabledFields['english_extended_description']) && $enabledFields['english_extended_description'] == true) {
                    $attributes[] = 'english_extended_description:html';
                }
                if (!empty($enabledFields['willingness_foreign_partners']) && $enabledFields['willingness_foreign_partners'] == true) {
                    $attributes[] = 'willingness_foreign_partners:boolean';
                }
                if (!empty($enabledFields['work_language_id']) && $enabledFields['work_language_id'] == true) {
                    $attributes[] = 'workLanguage.work_language';
                }
                if (!empty($enabledFields['development_stage_id']) && $enabledFields['development_stage_id'] == true) {
                    $attributes['developmentStage.value'] = [
                        'attribute' => 'developmentStage.value',
                        'label' => Module::t('amospartnershipprofiles', 'Development stage')
                    ];
                }
                if (!empty($enabledFields['other_development_stage']) && $enabledFields['other_development_stage'] == true) {
                    $attributes[] = 'other_development_stage.work_language';
                }
                if (!empty($enabledFields['intellectual_property_id']) && $enabledFields['intellectual_property_id'] == true) {
                    $attributes['intellectualProperty.value'] = [
                        'attribute' => 'intellectualProperty.value',
                        'label' => Module::t('amospartnershipprofiles', 'Intellectual property')
                    ];
                }
                if (!empty($enabledFields['other_intellectual_property']) && $enabledFields['other_intellectual_property'] == true) {
                    $attributes[] = 'other_intellectual_property';
                }
            }

            if (!empty($enabledFields['attrPartnershipProfilesTypesMm']) && $enabledFields['attrPartnershipProfilesTypesMm'] == true) {
                [
                    'label' => Module::t('amospartnershipprofiles', 'Partnership Profiles Types'),
                    'value' => function ($model) {
                        /** @var PartnershipProfiles $model */
                        return $model->getPartnershipProfileTypesString();
                    }
                ];
            }

            ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => $attributes,
                'options' => ['class' => 'table-info']
            ]) ?>
        </div>
    </div>
    <?php $this->endBlock(); ?>
    <?php
    $itemsTab[] = [
        'label' => Module::tHtml('amospartnershipprofiles', 'Card'),
        'content' => $this->blocks[$idTabCard],
        'options' => ['id' => $idTabCard],
    ];
    ?>

    <?php if (Yii::$app->getModule('tag')): ?>
        <?php $this->beginBlock($idClassifications); ?>
        <div class="body">
            <?= ShowUserTagsWidget::widget([
                'userProfile' => $model->id,
                'className' => $model->className()
            ]);
            ?>
        </div>
        <?php $this->endBlock(); ?>
        <?php
        $itemsTab[] = [
            'label' => Module::tHtml('amospartnershipprofiles', '#TabTag'),
            'content' => $this->blocks[$idClassifications],
            'options' => ['id' => $idClassifications],
        ];
        ?>
    <?php endif; ?>

    <?php $this->beginBlock($idTabAttachments); ?>
    <!-- TODO sostituire il tag h3 con il tag p e applicare una classe per ridimensionare correttamente il testo per accessibilità -->
    <h3><?= Module::tHtml('amospartnershipprofiles', 'Attachments') ?></h3>
    <?= AttachmentsTableWithPreview::widget([
        'model' => $model,
        'attribute' => 'partnershipProfileAttachments',
        'viewDeleteBtn' => false
    ]) ?>
    <?php $this->endBlock(); ?>

    <div class="clearfix"></div>
    <?php
    $itemsTab[] = [
        'label' => Module::tHtml('amospartnershipprofiles', 'Attachments'),
        'content' => $this->blocks[$idTabAttachments],
        'options' => ['id' => $idTabAttachments],
    ];
    ?>

    <?php if (\backend\modules\aster_partnership_profiles\utility\PartnershipProfilesUtility::renderViewAnimationTab($model)) :
        \backend\modules\aster_partnership_profiles\utility\PartnershipProfilesUtility::initInvitation($model->id);
        ?>
        <?php $this->beginBlock($idTabAnimator); ?>


        <!--< ? php if (empty($model->sfide_community_id)) { ?>
            < ?=
            \yii\helpers\Html::button('Crea Gruppo di lavoro', [
                'class' => 'btn btn-navigation-primary community-create',
                'id' => 'create-community-button',
            ]);
            ?>
        < ?php } else { ?>
            < ?=
            \yii\helpers\Html::a('Accedi al Gruppo di lavoro', [
                '/community/join', 'id' => $model->sfide_community_id
            ], [

                'class' => 'btn btn-primary community-access',
                'id' => 'access-community-button',
                'target' => 'blanck',
            ]);
            ?>
        < ?php } ?>

    <div class="form-group">
        < ? php echo Html::hiddenInput('create_community_box', '', ['id' => 'create-community-box-id']); ?>
    </div>
    <div id="community-flash-messages-container"></div>



    < ?php
        \yii\bootstrap\Modal::begin([
            'header' => '<h4 class="modal-title">Crea Gruppo di lavoro</h4>',
            'id' => 'modal-create-community',
            'footer' =>

                \yii\helpers\Html::tag('div',
                    Html::a(Module::tHtml('amoscore', '#cancel'), null, ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) .
                    Html::a(Module::t('partnershipprofiles', 'Si'), '/partnershipprofiles/partnership-profiles/create-community?id=' . $model->id, ['class' => 'btn btn-navigation-primary ok-modal-btn']),
                    ['class' => 'pull-right m-15-0']
                )
        ])
    ?>
    <h4>< ?= \arter\amos\admin\AmosAdmin::t('amosadmin', 'Verrà creato un Gruppo di lavoro per la sfida, confermi?') ?></h4>
    < ?php
        \yii\bootstrap\Modal::end();
    ?>-->
        <div class="row">
            <div class="col-xs-12">

                <div class="col-xs-12">
                    <h2 class="subtitle-form"><?= Module::t('amospartnershipprofiles', 'Invita EROI interessati') ?></h2>
                    <h4 class="title"><?= AmosIcons::show('info-outline'); ?> <?= Module::t('amospartnershipprofiles', 'Cerca tra gli EROI che hanno selezionato almeno una delle aree di interesse presenti nella Sfida') ?></h4>
                </div>
                <div class="col-xs-12">
                    <?= \yii\helpers\Html::a('Ricerca EROI interessati da contattare', ['associate-users-tags-m2m', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?=
                    backend\modules\aster_partnership_profiles\widget\SendNotifyUsersWidget::widget([
                        'model' => $model,
                        'buttonType' => backend\modules\aster_partnership_profiles\widget\SendNotifyUsersWidget::TYPE_VIEW,
                        'checkList' => 'tag'
                    ])
                    ?>
                    <?php

                    $query = PartnershipProfilesUtility::getQueryToListUserAnimation($model, true, $_POST['genericSearch']);
                    $dataProvider = new ActiveDataProvider([
                        'query' => $query
                    ]);

                    //pr($query->createCommand()->getRawSql());
                    if ($dataProvider->totalCount > 0) {
                    $form = ActiveForm::begin([
                        'options' => [
                            'id' => 'list_users_animation_1',
                            'enctype' => 'multipart/form-data', // To load images
                            'errorSummaryCssClass' => 'error-summary alert alert-error'
                        ]
                    ]);

                    ?>

                    <div class="list-users-animation">
                        <div class="m2mwidget-generic-search">
                            <div class="col-xs-12 nop m-15-0">
                                <div class="col-sm-6 col-lg-4 nop">
                                    <!-- TODO Rimuovere hiddenInput fromGenericSearch quando funzionerà il pjax -->
                                    <?=
                                    Html::hiddenInput('fromGenericSearch', 0, [
                                        'id' => 'fromGenericSearchFieldId_tags'
                                    ]);
                                    ?>

                                    <?=
                                    Html::textInput('genericSearch', (isset($_POST['genericSearch']) ? $_POST['genericSearch'] : null), [
                                        'placeholder' => Module::t('partnershipprofiles', 'Cerca nei risultati visualizzati'),
                                        'id' => 'usertags-search-field', 'class' => 'form-control'
                                    ]);
                                    ?>
                                </div>

                                <div class="col-sm-6 col-lg-8">
                                    <?=
                                    Html::a(Yii::t('amosnews', 'Annulla'),
                                        [\yii\helpers\Url::current()],
                                        ['class' => 'btn btn-secondary'])
                                    ?>
                                    <?= Html::submitButton(Yii::t('amosnews', 'Cerca'), ['class' => 'btn btn-navigation-primary']) ?>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <?php ActiveForm::end();
                        } ?>

                        <?= $this->render('_list_users_animation', ['dataProvider' => $dataProvider, 'interested' => true]) . '<div class="clearfix"></div>'; ?>
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="col-xs-12">
                    <h2 class="subtitle-form"><?= Module::t('amospartnershipprofiles', 'Invita altri EROI') ?></h2>
                    <h4 class="title"><?= AmosIcons::show('info-outline'); ?> <?= Module::t('amospartnershipprofiles', 'Cerca altri EROI che hanno competenze o esperienze coerenti ai contenuti della Sfida') ?></h4>
                </div>
                <div class="col-xs-12">
                    <?= \yii\helpers\Html::a('Ricerca altri EROI da contattare', ['associate-users-m2m', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= backend\modules\aster_partnership_profiles\widget\SendNotifyUsersWidget::widget([
                        'model' => $model,
                        'buttonType' => backend\modules\aster_partnership_profiles\widget\SendNotifyUsersWidget::TYPE_VIEW,
                        'checkList' => 'notag'
                    ]) ?>
                    <?php

                    $query = PartnershipProfilesUtility::getQueryToListUserAnimation($model, false, $_POST['genericSearch1']);
                    $dataProvider = new ActiveDataProvider([
                        'query' => $query
                    ]);

                    ?>

                    <div class="list-users-animation">
                        <?php
                        if ($dataProvider->totalCount > 0) {
                            $form = ActiveForm::begin([
                                'options' => [
                                    'id' => 'list_users_animation_2',
                                    'enctype' => 'multipart/form-data', // To load images
                                    'errorSummaryCssClass' => 'error-summary alert alert-error'
                                ]
                            ]);
                            ?>
                            <div class="m2mwidget-generic-search">
                                <div class="col-xs-12 nop m-15-0">
                                    <div class="col-sm-6 col-lg-4 nop">
                                        <!-- TODO Rimuovere hiddenInput fromGenericSearch quando funzionerà il pjax -->
                                        <?=
                                        Html::hiddenInput('fromGenericSearch', 0, [
                                            'id' => 'fromGenericSearchFieldId_tag'
                                        ]);
                                        ?>

                                        <?=
                                        Html::textInput('genericSearch1', (isset($_POST['genericSearch1']) ? $_POST['genericSearch1'] : null), [
                                            'placeholder' => Module::t('partnershipprofiles', 'Cerca nei risultati visualizzati'),
                                            'id' => 'usertags-search-field', 'class' => 'form-control'
                                        ]);
                                        ?>
                                    </div>

                                    <div class="col-sm-6 col-lg-8">
                                        <?=
                                        Html::a(Yii::t('amosnews', 'Annulla'),
                                            [\yii\helpers\Url::current()],
                                            ['class' => 'btn btn-secondary'])
                                        ?>
                                        <?= Html::submitButton(Yii::t('amosnews', 'Cerca'), ['class' => 'btn btn-navigation-primary']) ?>

                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <?php ActiveForm::end();
                        } ?>
                        <?= $this->render('_list_users_animation', ['dataProvider' => $dataProvider, 'interested' => false]) . '<div class="clearfix"></div>'; ?>
                    </div>
                </div>
            </div>


            <div class="col-xs-12">
                <h2 class="subtitle-form"><?= Module::t('amospartnershipprofiles', 'Inviti Utenti Esterni') ?></h2>
                <h4 class="title"><?= AmosIcons::show('info-outline'); ?> <?= Module::t('amospartnershipprofiles', 'Invita su EROI persone ancora non iscritte che pensi possano offrire una soluzione alla Sfida') ?></h4>
            </div>
            <div class="col-xs-12">
                <?php
                $url = '/invitations/invitation/index';
                echo Html::a('Invita Utenti Esterni', [
                    $url,
                    'moduleName' => 'partnershipprofiles',
                    'contextModelId' => $model->id,
                ], [
                    'class' => 'btn btn-primary',
                    'target' => 'blank'
                ]);

                $modelsearch = new \arter\amos\invitations\models\search\InvitationSearch();
                $dataProviderinvitations = $modelsearch->search([
                    'moduleName' => 'partnershipprofiles',
                    'contextModelId' => $model->id,
                ]);
                ?>

                <?=
                AmosGridView::widget([
                    'dataProvider' => $dataProviderinvitations,
                    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
                    'columns' => [
                        'name',
                        'surname',
                        'invitationUser.email',
                        'send_time:datetime',
                    ],
                ]);
                ?>


            </div>
        </div>
        <?php $this->endBlock(); ?>

        <?php
        $itemsTab[] = [
            'label' => Module::tHtml('amospartnershipprofiles', '#TabAnimatore'),
            'content' => $this->blocks[$idTabAnimator],
            'options' => ['id' => $idTabAnimator]
        ];
        ?>
    <?php endif; ?>
    <?= Tabs::widget([
        'encodeLabels' => false,
        'items' => $itemsTab
    ]); ?>

</div>
</div>
