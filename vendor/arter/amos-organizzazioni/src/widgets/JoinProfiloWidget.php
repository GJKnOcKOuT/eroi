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
 * @package    arter\amos\organizzazioni\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\organizzazioni\widgets;

use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\organizzazioni\models\Profilo;
use arter\amos\organizzazioni\models\ProfiloUserMm;
use arter\amos\organizzazioni\Module;
use Yii;
use yii\base\Widget;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;

/**
 * Class JoinProfiloWidget
 * @package arter\amos\organizzazioni\widgets
 */
class JoinProfiloWidget extends Widget
{
    const MODAL_CONFIRM_BTN_OPTIONS = ['class' => 'btn btn-navigation-primary'];
    const MODAL_CANCEL_BTN_OPTIONS = [
        'class' => 'btn btn-secondary',
        'data-dismiss' => 'modal'
    ];
    const BTN_CLASS_DFL = 'btn btn-navigation-primary';

    /**
     * @var Profilo $model
     */
    public $model = null;

    /**
     * @var int $userId
     */
    public $userId = 0;

    /**
     * @var bool|false true if we are in edit mode, false if in view mode or otherwise
     */
    public $modalButtonConfirmationStyle = '';
    public $modalButtonConfirmationOptions = [];
    public $modalButtonCancelStyle = '';
    public $modalButtonCancelOptions = [];
    public $divClassBtnContainer = '';
    public $customBtnLabel = '';
    public $btnClass = '';
    public $btnStyle = '';
    public $btnOptions = [];
    public $isProfileView = false;
    public $isGridView = false;
    public $useIcon = false;

    public $onlyModals = false;
    public $onlyButton = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (is_null($this->model)) {
            throw new \Exception(Module::t('amosorganizzazioni', '#missing_model'));
        }

        if (empty($this->modalButtonConfirmationOptions)) {
            $this->modalButtonConfirmationOptions = self::MODAL_CONFIRM_BTN_OPTIONS;
            if (empty($this->modalButtonConfirmationStyle)) {
                if ($this->isProfileView) {
                    $this->modalButtonConfirmationOptions['class'] = $this->modalButtonConfirmationOptions['class'] . ' modal-btn-confirm-relative';
                }
            } else {
                $this->modalButtonConfirmationOptions = ArrayHelper::merge(self::MODAL_CONFIRM_BTN_OPTIONS, ['style' => $this->modalButtonConfirmationStyle]);
            }
        }
        if (empty($this->modalButtonCancelOptions)) {
            $this->modalButtonCancelOptions = self::MODAL_CANCEL_BTN_OPTIONS;
            if (empty($this->modalButtonCancelStyle)) {
                if ($this->isProfileView) {
                    $this->modalButtonCancelOptions['class'] = $this->modalButtonCancelOptions['class'] . ' modal-btn-cancel-relative';
                }
            } else {
                $this->modalButtonCancelOptions = ArrayHelper::merge(self::MODAL_CANCEL_BTN_OPTIONS, ['style' => $this->modalButtonCancelStyle]);
            }
        }

        if (empty($this->btnOptions)) {
            if (empty($this->btnClass)) {
                if ($this->isProfileView) {
                    $this->btnClass = 'btn btn-secondary';
                } elseif ($this->useIcon) {
                    $this->btnClass = 'btn btn-tool-secondary';
                } else {
                    $this->btnClass = self::BTN_CLASS_DFL;
                }
            }
            $this->btnOptions = ['class' => $this->btnClass . (($this->isGridView && !$this->useIcon) ? ' font08' : '')];
            if (!empty($this->btnStyle)) {
                $this->btnOptions = ArrayHelper::merge($this->btnOptions, ['style' => $this->btnStyle]);
            }
        }

    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        /** @var ProfiloUserMm $model */
        $model = $this->model;
        if ($model instanceof ProfiloUserMm) {
            $isUserOrganizationModel = true;
        } else {
            $isUserOrganizationModel = false;
        }

        $buttonUrl = null;
        $title = '';
        $dataTarget = '';
        $dataToggle = '';
        $userId = (($this->userId > 0) ? $this->userId : Yii::$app->getUser()->getId());

        if ($isUserOrganizationModel) {
            $userOrganization = $model;

            /** @var Profilo $modelProfilo */
            $modelProfilo = Module::instance()->createModel('Profilo');
            $model = $modelProfilo::findOne($userOrganization->profilo_id);
        } else {
            /** @var ProfiloUserMm $modelProfiloUserMm */
            $modelProfiloUserMm = Module::instance()->createModel('ProfiloUserMm');
            $userOrganization = $modelProfiloUserMm::findOne(['profilo_id' => $model->id, 'user_id' => $userId]);
        }

        if (is_null($userOrganization)) {
            $icon = 'plus';
            $title = (!empty($this->customBtnLabel) ? $this->customBtnLabel : Module::t('amosorganizzazioni', '#join'));
            $dataToggle = 'modal';
            $dataTarget = '#joinPopup-' . $model->id;
            $buttonUrl = null;
            Modal::begin([
                'id' => 'joinPopup-' . $model->id,
                'header' => $title
            ]);
            echo Html::tag('div',
                Module::t('amosorganizzazioni', "#do_you_wish_add") .
                " <strong>" . $model->name . "</strong> " . Module::t('amosorganizzazioni', "#to_your_network"));
            echo Html::tag('div',
                Html::a(Module::t('amosorganizzazioni', '#cancel'), null,
                    $this->modalButtonCancelOptions)
                . Html::a(Module::t('amosorganizzazioni', '#yes'),
                    ['/organizzazioni/profilo/join-organization', 'organizationId' => $model->id, 'userId' => $userId],
                    $this->modalButtonConfirmationOptions),
                ['class' => 'pull-right m-15-0']
            );
            Modal::end();
        }

        if (empty($title) || $this->onlyModals) {
            return '';
        } else {
            $this->btnOptions = ArrayHelper::merge($this->btnOptions, [
                'title' => $title
            ]);
        }
        if (isset($disabled)) {
            $this->btnOptions['class'] = $this->btnOptions['class'] . ' disabled';
        }
        if (!empty($dataTarget) && !empty($dataToggle)) {
            $this->btnOptions = ArrayHelper::merge($this->btnOptions, [
                'data-target' => $dataTarget,
                'data-toggle' => $dataToggle
            ]);
        }
        if ($this->useIcon) {
            $this->btnOptions['class'] = $this->btnOptions['class'] . ' m-r-5';
            $btn = Html::a(AmosIcons::show($icon), $buttonUrl, $this->btnOptions);
        } else {
            $btn = Html::a($title, $buttonUrl, $this->btnOptions);
        }
        if (!empty($this->divClassBtnContainer)) {
            $btn = Html::tag('div', $btn, ['class' => $this->divClassBtnContainer]);
        }

        return $btn;
    }
}
