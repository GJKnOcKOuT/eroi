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
 * @package    arter\amos\invitations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\ActiveForm;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\views\DataProviderView;
use arter\amos\invitations\Module;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var \arter\amos\invitations\models\search\InvitationSearch $model
 */

$this->title = Yii::t('amosinvitations', 'My invitations');
$this->params['breadcrumbs'][] = $this->title;


$js = <<<JS
 //--- SHOW the modal
    $(document).on('click','.re-send', function() {
        $('#modal_sent').modal('show')
            .find('#modal_content')
            .load($(this).attr('value'));
    });

JS;

$this->registerJs($js);
?>

<div class="invitation-index">
    <h4><?= Module::t('amosinvitations', '#introduction_invitation', ['platformName' => Yii::$app->name]) ?></h4>
    <?= $this->render('_search', ['model' => $model,]); ?>

    <?php
    $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]);
    ?>

    <?= $this->render('_modal', ['form' => $form, 'model' => $model, 'moduleName' => $moduleName,
        'contextModelId' => $contextModelId]) ?>

    <?= DataProviderView::widget([
        'dataProvider' => $dataProvider,
        'currentView' => $currentView,
        'gridView' => [
            'columns' => [
                [
                    'class' => 'arter\amos\core\views\grid\CheckboxColumn',
                    'name' => 'Invitation[selection]',
                    'header' => Module::t('amosinvitations', 'Selection'),
                    'checkboxOptions' => function ($model, $key, $index, $column) {
                        /** @var Invitation $model */
//                            if ($model->send) {
                        $retArray = \arter\amos\invitations\utility\InvitationsUtility::checkUserAlreadyPresent($model->invitationUser->email, true, true);
                        if ($retArray['present']) {
                            return [
                                'disabled' => true,
                                'title' => $retArray['message'],
                            ];
                        }
                    }
                ],
                'name',
                'surname',
                'invitationUser.email',
                'send_time:datetime',
                [
                    'class' => 'arter\amos\core\views\grid\ActionColumn',
                    'template' => '{view}{update}{re-send}{delete}',
                    'buttons' => [
                        'update' => function ($url, $model)  use ($moduleName, $contextModelId) {
                            /** @var \arter\amos\invitations\models\Invitation $model */
                            if (\Yii::$app->user->id == $model->created_by) {
                                $retArray = \arter\amos\invitations\utility\InvitationsUtility::checkUserAlreadyPresent($model->invitationUser->email, true, true);

                                if (!$model->send) {
                                    $label = Module::t('amosinvitations', 'Update and send invitation...');
                                } else {
                                    $label = Module::t('amosinvitations', 'Update and re-send invitation...');
                                }
                                $options = [
                                    'model' => $model,
                                    'class' => 'btn btn-tools-secondary',
                                    'title' => $label,
                                ];

                                //
                                if ($retArray['present']) {
                                    $options['disabled'] = true;
                                    $options['title'] = $retArray['message'];
                                    $options['class'] = 'btn btn-tools-secondary';
                                }

                                $btn = Html::a(
                                    AmosIcons::show('email'),
                                    !$retArray['present'] ?
                                        [
                                            'update',
                                            'id' => $model->id,
                                            'moduleName' => $moduleName,
                                            'contextModelId' => $contextModelId
                                        ] : 'javascript:void(0)',
                                    $options
                                );
                                return $btn;
                            }
//                                } else {
//                                    return '';
//                                }
                        },
                        're-send' => function ($url, $model) use ($moduleName, $contextModelId) {
                            /** @var \arter\amos\invitations\models\Invitation $model */
                            if ($model->send/**&& \Yii::$app->user->can('INVITATIONS_ADMINISTRATOR')**/) {
                                $retArray = \arter\amos\invitations\utility\InvitationsUtility::checkUserAlreadyPresent($model->invitationUser->email, true, true);
                                $options = [
                                    'model' => $model,
                                    'value' => \Yii::$app->urlManager->createUrl([
                                        '/invitations/invitation/invitations-sent', 'id' => $model->id,
                                        'ajax' => true,
                                        'moduleName' => $moduleName,
                                        'contextModelId' => $contextModelId
                                    ]),
                                    'class' => 'btn btn-tools-secondary re-send',
                                    'title' => Module::t('amosinvitations', 'Re-send invitation'),
                                ];
                                if ($retArray['present']) {
                                    $options['disabled'] = true;
                                    $options['title'] = $retArray['message'];
                                    $options['class'] = 'btn btn-tools-secondary';
                                }
                                $btn = Html::a(AmosIcons::show('refresh-sync'), 'javascript:void(0)', $options);
                                return $btn;
                            }
                            return '';
                        }
                    ]
                ],
            ],
        ],
    ]); ?>


    <?= Html::button(Module::t('amosinvitations', 'Send all selected'), [
        'class' => 'btn btn-primary pull-right',
        'value' => 'send-invitation',
        'type' => 'submit',
        'name' => 'submit-invitation',
        'data-confirm' => Module::t('amosinvitations', '#are-you-sure-send-all')
    ]);
    ?>

    <?php ActiveForm::end(); ?>

</div>
<?php
\yii\bootstrap\Modal::begin(['id' => 'modal_sent', 'size' => 'modal-lg', 'header' => Module::t('amosinvitations', 'Re-send invitation')]);
echo "<div id='modal_content'></div>";
\yii\bootstrap\Modal::end();

?>
