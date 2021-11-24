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


use arter\amos\core\helpers\Html;
use arter\amos\core\views\DataProviderView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\models\EenExprOfInterestSearch $model
 */

$this->title = \arter\amos\een\AmosEen::t('amoseen', '#expr_of_interest');
$this->params['breadcrumbs'][] = $this->title . ' '. \arter\amos\een\AmosEen::t('amoseen', 'sended');
?>
<div class="een-expr-of-interest-index">
    <?php  echo $this->render('_search', ['model' => $model]); ?>

<!--    --><?php //$this->beginBlock('general'); ?>
    <?php echo \arter\amos\core\views\AmosGridView::widget([
        'dataProvider' => $dataProvider,

            'columns' => [
                'eenPartnershipProposal.reference_external',
                'eenPartnershipProposal.content_title',
                [
                        'label' => \arter\amos\een\AmosEen::t('amoseen', 'Status'),
                        'attribute' => 'workflowStatus.label',
                        'value' => function($model) {
                            $substatus = "";
                            if($model->sub_status) {
                                $substatus = '('.$model->getSubstatus()[$model->sub_status].')';
                            }
                            return \arter\amos\een\AmosEen::t('amoseen', $model->workflowStatus->label). ' '. $substatus;
                        }
                ],

                [
                   'attribute' => 'is_request_more_info',
                    'value' => function($model){
                        if($model->is_request_more_info == 1){
                            return \arter\amos\een\AmosEen::t('amoseen','Richiesta informazioni');
                        }
                        else return \arter\amos\een\AmosEen::t('amoseen','#expr_of_interest');
                    },
                    'label' => \arter\amos\een\AmosEen::t('amoseen', '#tipologia')

                ],
                [
                    'attribute' => 'een_staff_id',
                    'value' => function ($model) {
                        if (!empty($model->eenStaff->user->userProfile)) {
                            return $model->eenStaff->user->userProfile->nomeCognome;
                        } else return '';
                    },
                    'label' => \arter\amos\een\AmosEen::t('amoseen', '#assigned_to'),
                ],
                [
                    'label' => \arter\amos\een\AmosEen::t('amoseen', 'Presa in carico'),
                    'value' => function ($model) {
                        if($model->status != \arter\amos\een\models\EenExprOfInterest::EEN_EXPR_WORKFLOW_STATUS_SUSPENDED){
                            return true;
                        }
                        else return false;
                    },
                    'format' => 'boolean'
                ],
                [
                    'attribute'=>'created_at',
                    'format'=> 'datetime',
                ],
                [
                    'class' => 'arter\amos\core\views\grid\ActionColumn',
                    'template' => '{proposal_partnership}{view}{not_interested}',
                    'buttons' => [
                        'proposal_partnership' => function($url, $model){
                            /** @var $model \arter\amos\een\models\EenExprOfInterest */
                            return Html::a(\arter\amos\core\icons\AmosIcons::show('assignment'), ['/een/een-partnership-proposal/view', 'id' => $model->een_partnership_proposal_id], [
                                    'class' => ['btn btn-tools-secondary'],
                                    'title' => \arter\amos\een\AmosEen::t('amoseen', '#partnership_proposal')
                            ]);
                        },
                        'view' => function($url, $model){
                            /** @var $model \arter\amos\een\models\EenExprOfInterest */
                                return Html::a(\arter\amos\core\icons\AmosIcons::show('file'), [$url], [
                                    'class' => ['btn btn-tools-secondary'],
                                    'title' => $model->is_request_more_info ? \arter\amos\een\AmosEen::t('amoseen', '#view_request_info') : \arter\amos\een\AmosEen::t('amoseen', '#view_edit_expr_of_interest')
                                ]);
                        },
                        'update' => function($url, $model){
                            /** @var $model \arter\amos\een\models\EenExprOfInterest */
                            if($model->is_request_more_info == 0 &&  $model->status == \arter\amos\een\models\EenExprOfInterest::EEN_EXPR_WORKFLOW_STATUS_SUSPENDED) {
                                return Html::a(\arter\amos\core\icons\AmosIcons::show('edit'), [$url], [
                                    'class' => ['btn btn-tools-secondary'],
                                    'title' => \arter\amos\een\AmosEen::t('amoseen', '#edit_expr_of_interest')
                                ]);
                            }
                            else return '';
                        },
                        'not_interested' => function($url, $model){
                            /** @var $model \arter\amos\een\models\EenExprOfInterest */
                            if($model->status == \arter\amos\een\models\EenExprOfInterest::EEN_EXPR_WORKFLOW_STATUS_SUSPENDED) {
                                return Html::a(\arter\amos\core\icons\AmosIcons::show('close-circle'), ['/een/een-expr-of-interest/not-interested', 'id' => $model->id], [
                                    'class' => ['btn btn-danger-inverse'],
                                    'title' => \arter\amos\een\AmosEen::t('amoseen', '#cancel_expr_of_interest'),
                                    'data-confirm' => \arter\amos\een\AmosEen::t('amoseen', 'Sei sicuro di annullare la richiesta?')
                                ]);
                            }
                            else return '';
                        },
                    ]
                ],
        ],
    ]); ?>
<!--    --><?php //$this->endBlock(); ?>
    <div class="clearfix"></div>

<!--    --><?php
//    $itemsTab[] = [
//        'label' => \arter\amos\een\AmosEen::tHtml('amoseen', '#expr_of_interest_sended'),
//        'content' => $this->blocks['general'],
//        'options' => ['id' => 'tab-general'],
//    ];
//    ?>
<!---->
<!---->
<!--    --><?php //if(\Yii::$app->user->can('STAFF_EEN')) { ?>
<!--        --><?php //$this->beginBlock('received'); ?>
<!---->
<!--        --><?php //echo $this->render('_tab_received_index', ['dataProviderReceived' => $dataProviderReceived]);
//        $this->endBlock(); ?>
<!--        <div class="clearfix"></div>-->
<!---->
<!--        --><?php
//        $itemsTab[] = [
//            'label' => \arter\amos\een\AmosEen::tHtml('amoseen', 'Ricevute'),
//            'content' => $this->blocks['received'],
//            'options' => ['id' => 'tab-received'],
//        ];
//    } ?>
<!---->
<!--    --><?php //echo \arter\amos\core\forms\Tabs::widget([
//        'encodeLabels' => false,
//        'items' => $itemsTab
//    ]); ?>
</div>



