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
 * @package    arter\amos\core\forms
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\forms;

use arter\amos\core\helpers\Html;
use arter\amos\core\helpers\PermissionHelper;
use arter\amos\core\module\BaseAmosModule;
use arter\amos\core\record\Record;
use Yii;
use yii\base\Widget;
use yii\helpers\Url;

/**
 * Class CloseSaveButtonWidget
 * Renders the close and submit buttons also according to the permissions that the user has.
 *
 * @package arter\amos\core\forms
 */
class CloseSaveButtonWidget extends Widget
{
    public $layout = "<div id=\"form-actions\" class=\"wrap-button\">{buttonSubmit}{buttonClose}</div>";
    public $buttonSaveLabel;
    public $buttonNewSaveLabel;
    public $buttonTitleSave = '';
    public $buttonClassSave = 'btn btn-outline-primary';
    public $buttonClassClose = 'btn btn-outline-primary';
    public $buttonId;
    public $dataConfirm;
    public $dataTarget;
    public $dataToggle;
    private $permissionSave;
    private $urlClose;
    private $closeButtonLabel;
    private $buttonCloseVisibility = true;

    /**
     * @var \arter\amos\core\record\Record $model
     */
    private $model;

    /**
     * @see \kartik\base\Widget::init();
     *
     * Set of the permissionSave
     */
    public function init()
    {
        $actionName = Yii::$app->controller->action->id;
        $function = new \ReflectionClass($this->model->className());
        $modelName = $function->getShortName();
        $this->permissionSave = PermissionHelper::findPermissionModelAction($modelName, $actionName);

        parent::init();

        $this->initVariablesI18n();
    }

    public function initVariablesI18n()
    {
        if (empty($this->buttonSaveLabel)) {
            $this->setSaveLabel(BaseAmosModule::t('amoscore', '#save'));
        }
        if (empty($this->buttonNewSaveLabel)) {
            $this->buttonNewSaveLabel = BaseAmosModule::t('amoscore', '#create');
        }
    }

    public function getSaveLabel()
    {
        return $this->buttonSaveLabel;
    }

    public function setSaveLabel($label)
    {
        $this->buttonSaveLabel = $label;
    }

    /**
     * @return \yii\db\ActiveRecord
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param \yii\db\ActiveRecord $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getUrlClose()
    {
        return $this->urlClose;
    }

    /**
     * @param mixed $urlClose
     */
    public function setUrlClose($urlClose)
    {
        $this->urlClose = $urlClose;
    }

    /**
     * @return mixed
     */
    public function getCloseButtonLabel()
    {
        return $this->closeButtonLabel;
    }

    /**
     * @param mixed $closeButtonLabel
     */
    public function setCloseButtonLabel($closeButtonLabel)
    {
        $this->closeButtonLabel = $closeButtonLabel;
    }

    /**
     * @return string
     */
    public function getLayout()
    {
        return $this->layout;
    }

    public function run()
    {
        $content = preg_replace_callback("/{\\w+}/",
            function ($matches) {
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
     */
    public function renderSection($name)
    {
        switch ($name) {
            case '{buttonClose}':
                return $this->renderButtonClose();
            case '{buttonSubmit}':
                return $this->renderButtonSubmit();
            default:
                return false;
        }
    }

    public function renderButtonClose()
    {
        $options = $this->getOptionsClose();
        if (!$this->buttonCloseVisibility) {
            return '';
        }
        $urlClose = Url::previous();
        $closeButtonLabel = Yii::t('amoscore', 'Annulla');
        if (isset($this->urlClose)) {
            $urlClose = $this->urlClose;
        }
        if (isset($this->closeButtonLabel)) {
            $closeButtonLabel = $this->closeButtonLabel;
        }
        return Html::a($closeButtonLabel, $urlClose, ['class' => $options['class']]);
    }

    private function getOptionsClose()
    {
        $options = [
            'class' => $this->buttonClassClose,
        ];

        return $options;
    }

    public function renderButtonSubmit()
    {
        if ($this->checkRenderSubmitButtonMetadata()) {
            $options = $this->getOptionsSave();
            return Html::submitButton(
                $this->model->isNewRecord ? $this->buttonNewSaveLabel : $this->buttonSaveLabel, 
		$options, 
		$this->permissionSave, 
		['model' => $this->model]
	    );
        } else {
            return '';
        }
    }

    /**
     * Check that the status of the entity passed to the widget has the metadata "submitVisible"...
     * @return bool
     */
    private function checkRenderSubmitButtonMetadata()
    {
        $metadata = 'submitVisible';
        $renderButton = true;
        if (!empty($this->model)) {
            /** @var Record $model */
            $model = $this->model;
            if (method_exists($model, 'hasWorkflowStatus')) {
                if ($model->hasWorkflowStatus()) {
                    $visible = $model->getWorkflowStatus()->getMetadata($metadata);
                    if (!empty($visible) && (strtoupper($visible) == 'NO')) {
                        $renderButton = false;
                    }
                }
            }
        }
        return $renderButton;
    }

    private function getOptionsSave()
    {
        $options = [
            'class' => $this->buttonClassSave,
        ];
        if (isset($this->buttonId)) {
            $options['id'] = $this->buttonId;
        }
        if (isset($this->dataConfirm)) {
            $options['data-confirm'] = $this->dataConfirm;
        }
        if (isset($this->dataTarget)) {
            $options['data-target'] = $this->dataTarget;
        }
        if (isset($this->dataToggle)) {
            $options['data-toggle'] = $this->dataToggle;
        }
        if (strlen($this->buttonTitleSave) > 0) {
            $options['title'] = $this->buttonTitleSave;
        }
        return $options;
    }

    /**
     * @return bool
     */
    public function isButtonCloseVisibility()
    {
        return $this->buttonCloseVisibility;
    }

    /**
     * @param bool $buttonCloseVisibility
     */
    public function setButtonCloseVisibility($buttonCloseVisibility)
    {
        $this->buttonCloseVisibility = $buttonCloseVisibility;
    }
}
