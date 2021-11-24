<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_organizzazioni\views\profilo
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\attachments\components\AttachmentsList;
use arter\amos\core\forms\AccordionWidget;
use arter\amos\core\forms\ContextMenuWidget;
use arter\amos\core\forms\ListTagsWidget;
use arter\amos\core\forms\MapWidget;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\organizzazioni\assets\OrganizzazioniAsset;
use arter\amos\organizzazioni\models\ProfiloSedi;
use arter\amos\organizzazioni\Module;

/**
 * @var yii\web\View $this
 * @var arter\amos\organizzazioni\models\Profilo $model
 */

$moduleL = \Yii::$app->getModule('layout');
if (!empty($moduleL)) {
    OrganizzazioniAsset::register($this);
}

$this->title = strip_tags($model);
$this->params['breadcrumbs'][] = $this->title;

/** @var Module $organizzazioniModule */
$organizzazioniModule = Yii::$app->getModule(Module::getModuleName());

/** @var ProfiloSedi $emptyProfiloSedi */
$emptyProfiloSedi = Module::instance()->createModel('ProfiloSedi');

$operativeHeadquarter = $model->operativeHeadquarter;
$hasOperativeHeadquarter = !empty($operativeHeadquarter);

$legalHeadquarter = $model->legalHeadquarter;
$hasLegalHeadquarter = !is_null($legalHeadquarter);

?>

<div class="organizzazioni-view col-xs-12 nop">

    <div class="col-xs-12 info-view-header">

        <div class="col-md-3 col-xs-12 nop">
            <?php
            $url = '/img/img_default.jpg';
            if (!is_null($model->logoOrganization)) {
                $url = $model->logoOrganization->getUrl('original', [
                    'class' => 'img-responsive'
                ]);
            }
            ?>
            <img class="img-responsive" src="<?= $url ?>" alt="<?= $model->name ?>">
            <div class="col-xs-12 subsection-info-view-header nop">
                <p class="organization-title"><?= $model->name ?></p>
                <span class="organization-site">
                <?php if (!empty($model->sito_web)): ?>
                    <?php $btnTitle = Module::t('amosorganizzazioni', '#visit_website_btn_title'); ?>
                    <?= Html::a($btnTitle, $model->sito_web, [
                        'title' => $btnTitle,
                        'class' => 'btn btn-navigation-secondary',
                        'target' => 'blank'
                    ]); ?>
                <?php endif; ?>
                </span>
            </div>
        </div>

        <div class="col-md-5 col-xs-12 info-body nop">
            <div class="col-md-12 col-xs-12 nop">
                <div class="col-xs-4 nop info-label"><?= $model->getAttributeLabel('tipologia_di_organizzazione') ?></div>
                <div class="col-xs-8 nop info-value"><?= (!is_null($model->tipologiaDiOrganizzazione) ? $model->tipologiaDiOrganizzazione->name : '-') ?></div>
            </div>
            <div class="col-md-12 col-xs-12 nop">
                <div class="col-xs-4 nop info-label"><?= $model->getAttributeLabel('codice_fiscale') ?></div>
                <div class="col-xs-8 nop info-value"><?= ($model->codice_fiscale ? $model->codice_fiscale : '-') ?></div>
            </div>
            <div class="col-md-12 col-xs-12 m-t-15 nop">
                <div class="col-xs-4 nop info-label"><?= $emptyProfiloSedi->getAttributeLabel('email') ?></div>
                <div class="col-xs-8 nop info-value"><?= $hasOperativeHeadquarter ? $operativeHeadquarter->email : '-' ?></div>
            </div>
            <!--            <div class="col-lg-12 col-xs-12 nop">-->
            <!--                <div class="col-xs-4 nop info-label">-->
            <?php //echo $model->getAttributeLabel('sito_web') ?><!--</div>-->
            <!--                <div class="col-xs-8 nop info-value">--><?php //echo $model->sito_web ?><!--</div>-->
            <!--            </div>-->
            <div class="col-md-12 col-xs-12 m-t-15 nop">
                <div class="col-xs-4 nop info-label"><?= $emptyProfiloSedi->getAttributeLabel('address') ?></div>
                <div class="col-xs-8 nop info-value"><?= $model->getAddressFieldForView() ?></div>
            </div>
        </div>

        <div class="col-md-4 col-xs-12 nop">
            <?= ContextMenuWidget::widget([
                'model' => $model,
                'actionModify' => $model->getFullUpdateUrl(),
                'actionDelete' => $model->getFullDeleteUrl()
            ]) ?>
            <?php
            if (!$organizzazioniModule->oldStyleAddressEnabled) {
                $sedeIndirizzo = $model->sedeIndirizzo;
                if ($sedeIndirizzo) {
                    echo Html::tag('div',
                        MapWidget::widget([
                            'coordinates' => [
                                'lat' => $sedeIndirizzo->latitude,
                                'lng' => $sedeIndirizzo->longitude,
                            ],
                            'zoom' => 17
                        ]),
                        ['class' => 'organization-header-map']
                    );
                }
            }
            ?>
        </div>

        <?php if ($organizzazioniModule->enableMembershipOrganizations && !is_null($model->parent)): ?>
            <div class="col-xs-12 father-organization-container">
                <div class="col-xs-12 father-organization-content">
                    <div class="father-organization-image col-md-4 col-xs-12 nop">
                        <?php
                        $urlParent = '/img/img_default.jpg';
                        if (!is_null($model->parent->logoOrganization)) {
                            $urlParent = $model->parent->logoOrganization->getUrl('original', [
                                'class' => 'img-responsive'
                            ]);
                        }
                        ?>
                        <?= Html::img($urlParent, [
                            'alt' => $model->parent->name
                        ]) ?>
                        <div>
                            <span><?= Module::t('amosorganizzazioni', '#father_organization'); ?></span>
                            <p><?= $model->parent->name ?></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12 nop">
                        <span><?= $model->parent->getAttributeLabel('responsabile') ?></span>
                        <span><?= $model->parent->responsabile ?></span>
                    </div class="col-md-4 col-xs-12 nop">
                    <div>
                        <span>
                            <?= $model->parent->sito_web ?>
                        </span>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <div class="col-xs-12 info-view-body">
        <div class="col-md-4 col-xs-12 nop">
            <div class="col-xs-4 nop info-label"><?= $model->getAttributeLabel('referente_operativo') ?></div>
            <div class="col-xs-8 nop info-value"><?= !empty($model->referenteOperativo) ? $model->referenteOperativo->nomeCognome : "" ?></div>
        </div>
        <div class="col-md-12 col-xs-12 nop">
            <div class="col-xs-4 nop info-label description-label"><?= $model->getAttributeLabel('presentazione_della_organizzaz') ?></div>
            <div class="col-xs-8 nop info-value"><?= $model->presentazione_della_organizzaz ?></div>
        </div>
    </div>

    <div class="col-md-8 col-xs-12">
        <?php
        $accordionSedeLegale = '';
        $sedeLegaleIndirizzo = '';
        $mapSedeLegale = '';

        if (!$organizzazioniModule->oldStyleAddressEnabled) {
            $sedeLegaleIndirizzo = $model->sedeLegaleIndirizzo;
            if ($sedeLegaleIndirizzo) {
                $mapSedeLegale = MapWidget::widget([
                    'coordinates' => [
                        'lat' => $sedeLegaleIndirizzo->latitude,
                        'lng' => $sedeLegaleIndirizzo->longitude,
                    ],
                    'zoom' => 17
                ]);
            }
        }

        $accordionSedeLegale .= Html::tag('div',
            $mapSedeLegale,
            ['class' => 'col-md-5 col-xs-6']
        );

        if ($hasLegalHeadquarter) {
            $slIndirizzo = Html::tag('div',
                Html::tag('div',
                    $legalHeadquarter->getAttributeLabel('address'),
                    ['class' => 'col-xs-4 nop info-label']) .
                Html::tag('div',
                    $model->getAddressFieldSedeLegaleForView(),
                    ['class' => 'col-xs-8 nop info-value']),
                ['class' => 'col-xs-12 nop']);

            $slEmail = Html::tag('div',
                Html::tag('div',
                    $legalHeadquarter->getAttributeLabel('email'),
                    ['class' => 'col-xs-4 nop info-label']) .
                Html::tag('div',
                    $legalHeadquarter->email,
                    ['class' => 'col-xs-8 nop info-value']),
                ['class' => 'col-xs-12 nop']);

            $slPec = Html::tag('div',
                Html::tag('div',
                    $legalHeadquarter->getAttributeLabel('pec'),
                    ['class' => 'col-xs-4 nop info-label']) .
                Html::tag('div',
                    $legalHeadquarter->pec,
                    ['class' => 'col-xs-8 nop info-value']),
                ['class' => 'col-xs-12 nop']);

            $slTelefono = Html::tag('div',
                Html::tag('div',
                    $legalHeadquarter->getAttributeLabel('phone'),
                    ['class' => 'col-xs-4 nop info-label']) .
                Html::tag('div',
                    $legalHeadquarter->phone,
                    ['class' => 'col-xs-8 nop info-value']),
                ['class' => 'col-xs-12 nop']);

            $slFax = Html::tag('div',
                Html::tag('div',
                    $legalHeadquarter->getAttributeLabel('fax'),
                    ['class' => 'col-xs-4 nop info-label']) .
                Html::tag('div',
                    $legalHeadquarter->fax,
                    ['class' => 'col-xs-8 nop info-value']),
                ['class' => 'col-xs-12 nop']);

            $accordionSedeLegale .= Html::tag('div',
                $slIndirizzo . $slEmail . $slPec . $slTelefono . $slFax,
                ['class' => 'col-md-7 col-xs-6']
            );
        }

        ?>

        <?php if ($organizzazioniModule->enableSocial): ?>
            <?php
            $accordionSocial = '';

            if(!empty($model->facebook)) {
                try {
                    $accordionSocial .= Html::tag('div',
                                    AmosIcons::show('facebook-box') . Html::tag('span', Html::a($model->facebook, $model->facebook, ['target' => '_blank'])),
                                    ['class' => 'col-sm-6 col-xs-12']);
                } catch (Exception $ex) {
                    $accordionSocial .= Html::tag('div',
                                    AmosIcons::show('facebook-box') . Html::tag('span', $model->facebook),
                                    ['class' => 'col-sm-6 col-xs-12']);
                }
            }			
            if(!empty($model->twitter)) {
                try {
                    $accordionSocial .= Html::tag('div',
                                    AmosIcons::show('twitter-box') . Html::tag('span', Html::a($model->twitter, $model->twitter, ['target' => '_blank'])),
                                    ['class' => 'col-sm-6 col-xs-12']);
                } catch (Exception $ex) {
                    $accordionSocial .= Html::tag('div',
                                    AmosIcons::show('twitter-box') . Html::tag('span', $model->twitter),
                                    ['class' => 'col-sm-6 col-xs-12']);
                }
            }
            if(!empty($model->google)) {
                try {
                    $accordionSocial .= Html::tag('div',
                                    AmosIcons::show('google-plus-box') . Html::tag('span', Html::a($model->google, $model->google, ['target' => '_blank'])),
                                    ['class' => 'col-sm-6 col-xs-12']);
                } catch (Exception $ex) {
                    $accordionSocial .= Html::tag('div',
                                    AmosIcons::show('google-plus-box') . Html::tag('span', $model->google),
                                    ['class' => 'col-sm-6 col-xs-12']);
                }
            }
            if(!empty($model->linkedin)) { 
                try {
                    $accordionSocial .= Html::tag('div',
                                    AmosIcons::show('linkedin-box') . Html::tag('span', Html::a($model->linkedin, $model->linkedin, ['target' => '_blank'])),
                                    ['class' => 'col-sm-6 col-xs-12']);
                } catch (Exception $ex) {
                    $accordionSocial .= Html::tag('div',
                                    AmosIcons::show('linkedin-box') . Html::tag('span', $model->linkedin),
                                    ['class' => 'col-sm-6 col-xs-12']);
                }
            }
            ?>
            <?php
            if(!empty($accordionSocial)) {
                echo AccordionWidget::widget([
                    'items' => [
                        [
                            'header' => Module::t('amosorganizzazioni', '#view_accordion_social'),
                            'content' => $accordionSocial,
                        ]
                    ],
                    'headerOptions' => ['tag' => 'h2'],
                    'clientOptions' => [
                        'collapsible' => true,
                        'active' => false,
                        'icons' => [
                            'header' => 'ui-icon-amos am am-plus-square',
                            'activeHeader' => 'ui-icon-amos am am-minus-square',
                        ]
                    ],
                    'options' => [
                        'class' => 'social-accordion'
                    ]
                ]);
            }
            ?>
        <?php endif; ?>

        <?= AccordionWidget::widget([
            'items' => [
                [
                    'header' => Module::t('amosorganizzazioni', '#other_headquarters'),
                    'content' => $this->render('_other_headquarters', ['model' => $model, 'isView' => true]),
                ]
            ],
            'headerOptions' => ['tag' => 'h2'],
            'clientOptions' => [
                'collapsible' => true,
                'active' => 1,
                'icons' => [
                    'header' => 'ui-icon-amos am am-plus-square',
                    'activeHeader' => 'ui-icon-amos am am-minus-square',
                ]
            ],
        ]); ?>

        <?= AccordionWidget::widget([
            'items' => [
                [
                    'header' => Module::t('amosorganizzazioni', '#employees'),
                    'content' => $this->render('_employees', ['model' => $model, 'isView' => true]),
                ]
            ],
            'headerOptions' => ['tag' => 'h2'],
            'clientOptions' => [
                'collapsible' => false,
                'active' => false,
                'icons' => [
                    'header' => 'ui-icon-amos am am-plus-square',
                    'activeHeader' => 'ui-icon-amos am am-minus-square',
                ]
            ],
        ]); ?>
    </div>
    <div class="col-md-4 col-xs-12">
        <?php if ($organizzazioniModule->enableMembershipOrganizations): ?>
            <?php $childrenOrganizations = $model->children; ?>
            <?php if (!empty($childrenOrganizations)): ?>
                <?php
                $childrenH2Content = AmosIcons::show('building', ['class' => 'm-r-5'], 'dash');
                $childrenH2Content .= Module::t('amosorganizzazioni', '#children_organizations');
                $childrenH2Content .= ' (' . count($childrenOrganizations) . ')';
                $counter = 1;
                ?>
                <div class="col-xs-12 children-organizations-section-sidebar nop">
                    <?= Html::tag('h2', $childrenH2Content) ?>
                    <div class="col-xs-12">
                        <?php foreach ($childrenOrganizations as $childrenOrganization): ?>
                            <div class="children-organizations-list-item col-xs-12 nop">
                                <div class="children-organizations-list-item-image col-xs-3 nop">
                                    <?php
                                    $urlChild = '/img/img_default.jpg';
                                    if (!is_null($childrenOrganization->logoOrganization)) {
                                        $urlChild = $childrenOrganization->logoOrganization->getUrl('original', [
                                            'class' => 'img-responsive'
                                        ]);
                                    }
                                    ?>
                                    <?= Html::img($urlChild, [
                                        'class' => 'gridview-image',
                                        'alt' => $childrenOrganization->name
                                    ]) ?>
                                </div>
                                <div class="children-organizations-list-item-name col-xs-9 nop">
                                    <span><?= Module::t('amosorganizzazioni', '#child_organization') . ' ' . $counter; ?></span>
                                    <p><?= $childrenOrganization->name; ?></p>
                                </div>
                            </div>
                            <?php $counter++; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <?php if (\Yii::$app->getModule('tag')): ?>
            <div class="col-xs-12 tags-section-sidebar nop" id="section-tags">
                <?= Html::tag('h2', AmosIcons::show('tag', [], 'dash') . Module::t('amosorganizzazioni', '#tags_title')) ?>
                <div class="col-xs-12">
                    <?= ListTagsWidget::widget([
                        'userProfile' => $model->id,
                        'className' => $model->className(),
                        'viewFilesCounter' => true,
                    ]);
                    ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-xs-12 attachment-section-sidebar nop">
            <?= Html::tag('h2', AmosIcons::show('paperclip', [], 'dash') . Module::t('amosorganizzazioni', '#attachments_title')) ?>
            <div class="col-xs-12">
                <?= AttachmentsList::widget([
                    'model' => $model,
                    'attribute' => 'allegati',
                    'viewDeleteBtn' => false,
                    'viewDownloadBtn' => true,
                    'viewFilesCounter' => true,
                ]) ?>
            </div>
        </div>
    </div>
</div>
