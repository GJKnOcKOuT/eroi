<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_partnership_profiles\widget
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\aster_partnership_profiles\widget;

use backend\modules\aster_partnership_profiles\assets\PartnershipProfilesAsset;
use backend\modules\aster_partnership_profiles\utility\PartnershipProfilesUtility;
use backend\modules\aster_partnership_profiles\Module;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\record\Record;
use arter\amos\core\utilities\ModalUtility;
use yii\base\Widget;
use yii\web\View;

/**
 * Class SendNotifyWidget
 *
 * This widget render a button that open a modal. The modal contains
 * a textarea and a button to send a message to all TMBs and application provider
 * that use the API in service integrated status.
 * If the widget is used in a grid view you must register the javascript externally
 * to the widget with the static method registerWidgetJavascript() and set the
 * property "autoRegisterJavascript" to false.
 *
 * @package backend\modules\aster_partnership_profiles\widgets
 */
class SendNotifyWidget extends Widget
{
    const TYPE_GRID_VIEW = 1;
    const TYPE_VIEW = 2;

    /**
     * @var string $layout
     */
    public $layout = '{content}';

    /**
     * @var Api $model
     */
    private $model;

    /**
     * @var int $buttonType
     */
    private $buttonType = 0;

    /**
     * @var bool $autoRegisterJavascript
     */
    private $autoRegisterJavascript = true;

    /**
     * @throws E015CommonException
     */
    public function init()
    {
        parent::init();

//        if (is_null($this->model)) {
//            throw new E015CommonException(Module::t('e015api', '#send_notify_widget_missing_model'));
//        }
//
//        if (!($this->model instanceof Api)) {
//            throw new E015CommonException(Module::t('e015api', '#send_notify_widget_model_not_api'));
//        }
    }

    /**
     * @return string
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @return Record|CertificateInterface
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param Record $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return int
     */
    public function getButtonType()
    {
        return $this->buttonType;
    }

    /**
     * @param int $buttonType
     */
    public function setButtonType($buttonType)
    {
        $this->buttonType = $buttonType;
    }

    /**
     * @return bool
     */
    public function isAutoRegisterJavascript()
    {
        return $this->autoRegisterJavascript;
    }

    /**
     * @param bool $autoRegisterJavascript
     */
    public function setAutoRegisterJavascript($autoRegisterJavascript)
    {
        $this->autoRegisterJavascript = $autoRegisterJavascript;
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $content = preg_replace_callback("/{\\w+}/", function ($matches) {
            $content = $this->renderSection($matches[0]);
            return $content === false ? $matches[0] : $content;
        }, $this->layout);
        return $content;
    }

    /**
     * Renders a section of the specified name.
     * If the named section is not supported, false will be returned.
     * @param string $name the section name, e.g., `{summary}`, `{items}`.
     * @return string|boolean the rendering result of the section, or false if the named section is not supported.
     * @throws \Exception
     */
    protected function renderSection($name)
    {
        switch ($name) {
            case '{content}':
                return $this->renderContent();
            default:
                return false;
        }
    }

    /**
     * Render the widget content.
     * @return string
     */
    protected function renderContent()
    {
        $btn = '';

        if (PartnershipProfilesUtility::loggedUserIsAnimationOrCM()) {
            $createUrlParams = [
                '/partnershipprofiles/partnership-profiles/contatta-ajax',
            ];

            // Message section
            $messageSection =
                Html::tag('div', '', ['class' => 'alert message-to-user-class hidden', 'role' => 'alert']) .
                Html::tag('div',
                    Html::a(Module::tHtml('amoscore', '#close'), null, [
                        'class' => 'btn btn-secondary success-modal-close-btn hidden',
                        'data-dismiss' => 'modal'
                    ]),
                    ['class' => 'm-15-0']
                );
            
            $message = $this->getMessage();
            
            // Base modal content
            $baseModalContent =
                Html::hiddenInput('notify-api-id', $this->model->id, ['id' => 'notify_api_id-' . $this->model->id, 'class' => 'notify-api-id-class']) .
                Html::tag('div',
                    \arter\amos\core\forms\TextEditorWidget::widget([
                    'name' => 'notify-text',
                    'value' => $message,
                    'language' => substr(\Yii::$app->language, 0, 2),
                    'options' => [
                        'id' => 'notify_textarea_id-' . $this->model->id,
                        'class' => 'notify-textarea-class'
                    ],
                ]) ,

                    ['class' => 'col-xs-12 nop']
                ) .
                Html::tag('div',
                    Html::a(Module::tHtml('amoscore', '#cancel'), null, ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) .
                    Html::a(Module::t('partnershipprofiles', 'Invia'), $createUrlParams, ['class' => 'btn btn-navigation-primary send-notify-modal-btn']),
                    ['class' => 'pull-right m-15-0']
                );

            // Compose all modal content
            $content =
                $messageSection .
                Html::tag('div', $baseModalContent, ['class' => 'base-modal-content']).
                Html::tag('div', '', ['class' => 'loading hidden m-t-30']);

            // Create modal
            $modalId = ModalUtility::amosModalDefaultId() . '-' . $this->model->id;
            ModalUtility::amosModal([
                'id' => $modalId,
                'headerText' => Module::t('partnershipprofiles', 'Contatta EROE'),
                'modalBodyContent' => $content,
                'containerOptions' => ['class' => 'modal-utility modal-send-tmb-notify']
            ]);

            // Create send button
            
                    $btn = Html::a(Module::t('partnershipprofiles', 'Contatta'),
                        $createUrlParams,
                        [
                            'data-toggle' => 'modal',
                            'data-target' => '#' . $modalId,
                            'title' => Module::t('partnershipprofiles', 'Contatta'),
                            'class' => 'btn btn-navigation-primary',
                        ]
                    );

          
        }

        if ($this->autoRegisterJavascript) {
            static::registerWidgetJavascript();
        }

        return $btn;
    }

    
    private function getMessage() {
        $url = \yii\helpers\Url::to(\Yii::$app->params['platform']['backendUrl']);
        $modelAnimationMm = \backend\modules\aster_partnership_profiles\models\UsersAnimationMm::find()->andWhere(['id' => $this->model->id])->one();
        $eroe = \backend\modules\aster_admin\models\UserProfile::find()
                        ->andWhere(['user_id' => $modelAnimationMm->user_id])->one();
        $partnershipProfile = $modelAnimationMm->partnershipProfile;
        $facilitatore = $partnershipProfile->partnershipProfileFacilitator;
        $eroecreate = \backend\modules\aster_admin\models\UserProfile::find()
                        ->andWhere(['user_id' => $partnershipProfile->created_by])->one();
        $cm = \backend\modules\aster_admin\models\UserProfile::find()
                        ->andWhere(['user_id' => $partnershipProfile->getValidatorUsersId()[0]])->one();

        $linksfidaparams = '/partnershipprofiles/partnership-profiles/view/' . '?id=' . $partnershipProfile->id;
        $urlsfida = $url . $linksfidaparams;
        $sfidalink = Html::a(Module::t('amospartnershipprofiles', "sfida"), $urlsfida);

        $linksfaqparams = '/ticket/assistenza/cerca-faq' . '?categoriaSelezionataId=2';
        $urlsfida = $url . $linksfaqparams;
        $faqlink = Html::a(Module::t('amospartnershipprofiles', "FAQ Sfide"), $urlsfida);

        $linkusercmparams = '/admin/user-profile/view/' . '?id=' . $cm->id;
        $urlusercm = $url . $linkusercmparams;
        $usercmlink = Html::a(Module::t('amospartnershipprofiles', "Community Manager"), $urlusercm);

        $message = Module::t('amospartnershipprofiles', "#contactUser",
                        ['nomecognome' => $eroe->getNomeCognome(),
                            'eroecreate' => $eroecreate->getNomeCognome(),
                            'sfida' => $sfidalink,
                            'faq' => $faqlink,
                            'cm' => $usercmlink,
                            'animatore' => $facilitatore->getNomeCognome()]);
        return $message;
    }

    /**
     * This static method register the javascript and assets necessary to the widget.
     */
    public static function registerWidgetJavascript()
    {
        $js = <<<JS
                
	$(document).on('focusin', function(e) {
            if ($(event.target).closest(".mce-window").length) {
                e.stopImmediatePropagation();
            }
        });          
                
        $('.send-notify-modal-btn').on('click', function (event) {
            event.preventDefault();
            var modal = $(this).parents('.modal-send-tmb-notify');
            var hiddenInput = modal.find('input[name="notify-api-id"]');
            var apiId = hiddenInput.val();
            var id = 'notify_textarea_id-' + apiId;
            var notifyText = tinymce.get(id).getContent();	

            var dataArray = {
               notify_api_id: apiId,
               notify_text: notifyText
            };
            $.ajax({
                url: "" + $(this).attr("href"),
                type: 'post',
                data: dataArray,
                dataType: 'json',
                beforeSend: function (xhr) {
                    modal.find('.loading').removeClass('hidden');
                },
                complete: function (xhr, status) {
                    modal.find('.loading').addClass('hidden');
                },
                success: function (result,status,xhr) {
                    modal.find('.message-to-user-class').html(result.message);
                    modal.find('.message-to-user-class').removeClass('hidden');
                    if (result.success === 1) {
                        tinymce.get(id).setContent('');
                        modal.find('.message-to-user-class').addClass('alert-success');
                        modal.find('.message-to-user-class').removeClass('alert-danger');
                        modal.find('.base-modal-content').addClass('hidden');
                        modal.find('.success-modal-close-btn').removeClass('hidden');
                    } else if (result.success === 0) {
                        modal.find('.message-to-user-class').removeClass('alert-success');
                        modal.find('.message-to-user-class').addClass('alert-danger');
                    }
                location.reload();
                },
                error: function(xhr,status,error) {
                    modal.find('.loading').addClass('hidden');
                }
            });
            return false;
        });
        
        $('.success-modal-close-btn').on('click', function (event) {
            var modal = $(this).parents('.modal-send-tmb-notify');
            modal.find('.message-to-user-class').addClass('hidden');
            modal.find('.success-modal-close-btn').addClass('hidden');
            modal.find('.base-modal-content').removeClass('hidden');
        });
JS;
        \Yii::$app->view->registerJs($js, View::POS_READY);

        PartnershipProfilesAsset::register(\Yii::$app->view);

        $moduleL = \Yii::$app->getModule('layout');
        if (!is_null($moduleL)) {
            // Layout
            \arter\amos\layout\assets\SpinnerWaitAsset::register(\Yii::$app->view);
        } else {
            // Core
            \arter\amos\core\views\assets\SpinnerWaitAsset::register(\Yii::$app->view);
        }
    }
}
