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
 * @package    arter\amos\ticket\views\ticket
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\models\UserProfile;
use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\editors\Select;
use arter\amos\core\forms\TextEditorWidget;
use arter\amos\core\helpers\Html;
use arter\amos\core\user\User;
use arter\amos\workflow\widgets\WorkflowTransitionButtonsWidget;
use arter\amos\ticket\AmosTicket;
use arter\amos\ticket\models\Ticket;
use arter\amos\ticket\models\TicketCategorie;
use arter\amos\ticket\utility\TicketUtility;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var arter\amos\ticket\models\Ticket $model
 */

/** @var AmosTicket $module */
$module = \Yii::$app->getModule('ticket');
$isNewRecord = $model->isNewRecord;
$enableOrganizationNameString = (!empty($module) ? $module->enableOrganizationNameString : false);
$buttonLabel = ($isNewRecord ? AmosTicket::t('amosticket', 'Invia') : AmosTicket::t('amosticket', 'Modifica'));
$statusToRenderToHide = $model->getStatusToRenderToHide();
/** @var UserProfile $creatorUserProfile */
$creatorUserProfile = $model->createdUserProfile;

$nameCat = '';
/** @var TicketCategorie $cat */
$cat = null;
if ($isNewRecord && !empty($_GET['ticket_categoria_id'])) {
    $cat = TicketCategorie::findOne($_GET['ticket_categoria_id']);
    if (!empty($cat)) {
        $nameCat = $cat->nomeCompleto;
    }
}

if (empty($nameCat)) {
    $cat = $model->ticketCategoria;
    $nameCat = $cat->nomeCompleto;
}


$disableInfoFields = (!empty($module) ? $module->disableInfoFields : false);
$disableCategory = (!empty($module) ? $module->disableCategory : false);
$disableTicketOrganization = (!empty($module) ? $module->disableTicketOrganization : false);
?>

<div class="ticket-form col-xs-12 nop">
    <?php
    $form = ActiveForm::begin(['id' => 'ticket-form',]);
    $this->beginBlock('dettagli');
    if (!$isNewRecord) : ?>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <?= $model->getAttributeLabel('id') ?>: <?= $model->id ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if (!$disableInfoFields) { ?>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <?= $model->getAttributeLabel('ticket_categoria_id') ?>: <?= $nameCat ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <?= $model->getAttributeLabel('created_by') ?>:
                <?= $creatorUserProfile->nomeCognome ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <?= AmosTicket::t('amosticket', '#ticket_creator_email') ?>:
                <?= $creatorUserProfile->user->email ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <?= $model->getAttributeLabel('created_at') ?>:
                <?php
                $createdAt = $model->created_at;
                if ($isNewRecord) {
                    $createdAt = date('d-m-Y H:i:s');
                }
                echo Yii::$app->getFormatter()->asDatetime($createdAt);
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <?= $model->getAttributeLabel('status') ?>
                : <?= $model->hasWorkflowStatus() ? $model->getWorkflowStatus()->getLabel() : AmosTicket::t('amosticket', "TICKET_WORKFLOW_STATUS_PROCESSING") ?>
            </div>
        </div>
    <?php } ?>
    
    <?php if (!$disableCategory) { ?>
    <div class="row">
        
        <div class="col-lg-12 col-sm-12">
            <?php
            if (false) {
                $ticketCategories = TicketUtility::getTicketCategories(null, true)->orderBy('titolo')->all();
                $ticketCategoryId = $model->ticket_categoria_id;
                if (!$model->ticket_categoria_id && (count($ticketCategories) == 1)) {
                    $ticketCategoryId = $ticketCategories[0]->id;
                }

                echo $form->field($model, 'ticket_categoria_id')->widget(Select::className(),
                    [
                        'auto_fill' => true,
                        'options' => [
                            'placeholder' => AmosTicket::t('amosticket', '#category_field_placeholder'),
                            'id' => 'ticket_categoria_id-id',
                            'disabled' => false,
                            'value' => $ticketCategoryId
                        ],
                        'data' => ArrayHelper::map(
                            TicketUtility::getTicketCategories(null, true)
                                ->orderBy('titolo')
                                ->all(), 'id', 'titolo'
                        ),
                    ]);
            }

            if ($isNewRecord && !empty($_GET['ticket_categoria_id'])) {
                $model->ticket_categoria_id = $_GET['ticket_categoria_id'];
            }

            echo $form->field($model, 'ticket_categoria_id')->hiddenInput()->label(false);
            ?>
        </div>
    </div>

    <?php } ?>
    
    <?php if (!$disableTicketOrganization) { ?>
        <?php if ($enableOrganizationNameString) { ?>
            <div class="col-lg-12 col-sm-12">
                <?= $form->field($model, 'organization_name')->textInput(['maxlength' => true]) ?>
            </div>
        <?php } else { ?>
            <div class="col-lg-12 col-sm-12">
                <?php
                $searchOrganizationsUserId = ($isNewRecord ? Yii::$app->user->id : $model->created_by);
                echo $form->field($model, 'ticketOrganization')->widget(Select::classname(),
                    [
                        'data' => TicketUtility::getOrganizationsAndHeadquartersByUserId($searchOrganizationsUserId),
                        'language' => substr(Yii::$app->language, 0, 2),
                        'options' => [
                            'multiple' => false,
                            'placeholder' => AmosTicket::t('amosticket', 'Seleziona') . '...',
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                ?>
            </div>
        <?php } ?>
    <?php } ?>

    <div class="col-lg-12 col-sm-12">
        <?= $form->field($model, 'titolo')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-lg-12 col-sm-12">
        <?= $form->field($model, 'descrizione')->widget(TextEditorWidget::className(),
            [
                'clientOptions' => [
                    'placeholder' => AmosTicket::t('amosticket',
                        '#description_field_placeholder'),
                    'lang' => substr(Yii::$app->language, 0, 2)
                ]
            ]);
        ?>
    </div>

    <?php if (!is_null($cat) && $cat->enable_dossier_id): ?>
        <div class="col-lg-6 col-sm-6">
            <?= $form->field($model, 'dossier_id')->textInput(['maxlength' => true]) ?>
        </div>
    <?php endif; ?>
    <?php if (!is_null($cat) && $cat->enable_phone): ?>
        <div class="col-lg-6 col-sm-6">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
    <?php endif; ?>

    <div class="clearfix"></div>
    <?php $this->endBlock(); ?>

    <?= $this->blocks['dettagli'] ?>

    <?= WorkflowTransitionButtonsWidget::widget([
        'form' => $form,
        'model' => $model,
        'workflowId' => Ticket::TICKET_WORKFLOW,
        'viewWidgetOnNewRecord' => true,
        //'closeSaveButtonWidget' => CloseSaveButtonWidget::widget($config),
        'closeButton' => Html::a(AmosTicket::t('amosticket', 'Annulla'), Yii::$app->session->get('previousUrl'), ['class' => 'btn btn-secondary']),
        'initialStatusName' => "WAITING",
        'initialStatus' => Ticket::TICKET_WORKFLOW_STATUS_WAITING,
        'statusToRender' => $statusToRenderToHide['statusToRender'],

        //POII-1147 gli utenti validatore/facilitatore o ADMIN possono sempre salvare la news => parametro a false
        //altrimenti se stato VALIDATO => pulsante salva nascosto
        'hideSaveDraftStatus' => $statusToRenderToHide['hideDraftStatus'],

        'draftButtons' => [
            Ticket::TICKET_WORKFLOW_STATUS_WAITING => [
                'button' => Html::submitButton($buttonLabel, ['class' => 'btn btn-workflow']),
                'description' => AmosTicket::t('amosticket', 'il ticket verr?? al pi?? presto preso in carico')
            ],
            Ticket::TICKET_WORKFLOW_STATUS_PROCESSING => [
                'button' => Html::submitButton(AmosTicket::t('amosticket', 'Salva'), ['class' => 'btn btn-workflow']),
                'description' => 'le modifiche al ticket'
            ],
            'default' => [
                'button' => Html::submitButton(AmosTicket::t('amosticket', 'Salva in bozza'), ['class' => 'btn btn-workflow']),
                'description' => AmosTicket::t('amosticket', 'le modifiche al ticket'),
            ]
        ]
    ]);
    ?>

    <?php ActiveForm::end(); ?>
</div>
