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

use arter\amos\core\helpers\Html;
use kartik\select2\Select2;
use arter\amos\ticket\AmosTicket;
use arter\amos\ticket\models\Ticket;
use arter\amos\ticket\utility\TicketUtility;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var arter\amos\ticket\models\search\TicketSearch $model
 * @var yii\widgets\ActiveForm $form
 */

$hideStatus = (isset($this->params['hideStatus'])) ? $this->params['hideStatus'] : false;
$hideCreatedBy = (isset($this->params['hideCreatedBy'])) ? $this->params['hideCreatedBy'] : false;
$enableAutoOpenSearchPanel = !isset(\Yii::$app->params['enableAutoOpenSearchPanel']) || \Yii::$app->params['enableAutoOpenSearchPanel'] === true;

?>

<div class="ticket-search element-to-toggle" data-toggle-element="form-search">
    <div class="col-xs-12"><h2><?= AmosTicket::t('amosticket', 'Cerca per') ?>:</h2></div>

    <?php $form = ActiveForm::begin([
        'action' => Yii::$app->controller->action->id,
        'method' => 'get',
        'options' => [
            'class' => 'default-form'
        ]
    ]);
    ?>
    <?= Html::hiddenInput("enableSearch", $enableAutoOpenSearchPanel); ?>
    <?= Html::hiddenInput("currentView", Yii::$app->request->getQueryParam('currentView')); ?>

    <div class="col-sm-6 col-lg-4">
        <?= $form->field($model, 'id') ?>
    </div>
    <div class="col-sm-6 col-lg-4">
        <?= $form->field($model, 'general')->label(AmosTicket::t('amosticket', 'Ricerca libera')) ?>
    </div>
    <div class="col-sm-6 col-lg-4">
        <?= $form->field($model, 'titolo') ?>
    </div>
    <div class="col-sm-6 col-lg-4">
        <?= $form->field($model, 'dossier_id')->textInput() ?>
    </div>
    <div class="col-sm-6 col-lg-4">
        <?= $form->field($model, 'phone')->textInput() ?>
    </div>

    <div class="col-sm-6 col-lg-4">
        <?php
        $data = ArrayHelper::map(TicketUtility::getTicketCategories()->orderBy('titolo')->all(), 'id', 'nomeCompleto');
        echo $form->field($model, 'ticket_categoria_id')->widget(Select2::className(), [
                'data' => $data,
                'options' => ['placeholder' => AmosTicket::t('amosticket', 'Cerca per categoria ...')],
                'pluginOptions' => [
                    'tags' => true,
                    'allowClear' => true,
                ],
            ]
        );
        ?>
    </div>

    <?php if (!$hideCreatedBy) { ?>
        <div class="col-sm-6 col-lg-4">
            <?php
            $creator = '';
            $userProfileCreator = \arter\amos\admin\models\UserProfile::find()->andWhere(['user_id' => $model->created_by])->one();
            if (!empty($userProfileCreator)) {
                $creator = $userProfileCreator->getNomeCognome();
            }
            echo $form->field($model, 'created_by')->widget(Select2::className(), [
                    'data' => (!empty($model->created_by) ? [$model->created_by => $creator] : []),
                    'options' => ['placeholder' => AmosTicket::t('amosticket', 'Cerca ...')],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'minimumInputLength' => 3,
                        'ajax' => [
                            'url' => \yii\helpers\Url::to(['/admin/user-profile-ajax/ajax-user-list']),
                            'dataType' => 'json',
                            'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }')
                        ],
                    ],
                ]
            );
            ?>
        </div>
    <?php } // $hideCreatedBy ?>

    <?php if (!$hideStatus) { ?>
        <div class="col-sm-6 col-lg-4">
            <?php
            $data = [
                Ticket::TICKET_WORKFLOW_STATUS_WAITING => AmosTicket::t('amosticket', 'TICKET_WORKFLOW_STATUS_WAITING'),
                Ticket::TICKET_WORKFLOW_STATUS_PROCESSING => AmosTicket::t('amosticket', 'TICKET_WORKFLOW_STATUS_PROCESSING'),
                Ticket::TICKET_WORKFLOW_STATUS_CLOSED => AmosTicket::t('amosticket', 'TICKET_WORKFLOW_STATUS_CLOSED')];
            echo $form->field($model, 'statusSearch')->widget(Select2::className(), [
                    'data' => $data,
                    'options' => ['placeholder' => AmosTicket::t('amosticket', 'Cerca per stato ...')],
                    'pluginOptions' => [
                        'tags' => true,
                        'allowClear' => true,
                    ],
                ]
            )->label(AmosTicket::t('amosticket', 'Stato'));
            ?>
        </div>
    <?php } // $hideStatus ?>

    <div class="col-xs-12">
        <div class="pull-right">
            <?= Html::resetButton(AmosTicket::t('amosticket', 'Annulla'), ['class' => 'btn btn-secondary']) ?>
            <?= Html::submitButton(AmosTicket::t('amosticket', 'Cerca'), ['class' => 'btn btn-navigation-primary']) ?>
        </div>
    </div>

    <div class="clearfix"></div>
    <!--a><p class="text-center">Ricerca avanzata<br>
                < ?=AmosIcons::show('caret-down-circle');?>
            </p></a-->
    <?php ActiveForm::end(); ?>
</div>
