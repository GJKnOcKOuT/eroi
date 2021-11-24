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

use kartik\base\Widget;
use kartik\select2\Select2;

/**
 * Class WorkflowStateWidget
 * Renders
 *
 * @package arter\amos\core\forms
 */
class WorkflowStateWidget extends Widget {

    private $model;
    private $form;
    private $workflowId;

    /**
     * @return mixed
     */
    public function getWorkflowId() {
        return $this->workflowId;
    }

    /**
     * @param mixed $workflowId
     */
    public function setWorkflowId($workflowId) {
        $this->workflowId = $workflowId;
    }

    /**
     * @see \kartik\base\Widget::init();
     *
     * Set of the permissionSave
     */
    public function init() {

        parent::init();
    }

    /**
     * @return \yii\db\ActiveRecord
     */
    public function getModel() {
        return $this->model;
    }

    /**
     * @param \yii\db\ActiveRecord $model
     */
    public function setModel($model) {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getForm() {
        return $this->form;
    }

    /**
     * @param mixed $form
     */
    public function setForm($form) {
        $this->form = $form;
    }

    public function run() {
        $content = $this->form->field($this->model, 'status')->widget(Select2::classname(), [
            'options' => ['placeholder' => \Yii::t('amoscore', 'Digita il nome dello stato')],
            'data' => $this->getStatuses()
        ]);

        return $content;
    }

    private function getStatuses() {
        $workFlowStatus = [];   // Stati del workflow

        if ($this->model->hasWorkflowStatus()) {  // Ho già lo stato. Model già salvato una volta.
            $allStatus = $this->model->getWorkflow()->getAllStatuses();   // Tutti gli stati del workflow
            $modelStatus = $this->model->getWorkflowStatus()->getId();    // Stato del model
            $actualStatusObj = $allStatus[$modelStatus];
            $workFlowStatus[$actualStatusObj->getId()] = $actualStatusObj->getLabel();    // Aggiungo lo stato iniziale a quelli da visualizzare.
            // Composizione di tutti gli altri stati possibili a partire dall'attuale, ovvero le transazioni possibili.
            $transitions = $this->model->getWorkflowSource()->getTransitions($modelStatus);
            foreach ($transitions as $transition) {
                $workFlowStatus[$transition->getEndStatus()->getId()] = $transition->getEndStatus()->getLabel();
            }
        } else {                                // Non ho lo stato. Model mai salvato. Faccio vedere solo quello iniziale.
            $contentDefaultWorkflow = $this->model->getWorkflowSource()->getWorkflow($this->workflowId);
            $allStatus = $contentDefaultWorkflow->getAllStatuses();     // Tutti gli stati del workflow
            $initialStatusObj = $allStatus[$contentDefaultWorkflow->getInitialStatusId()];
            $workFlowStatus[$initialStatusObj->getId()] = $initialStatusObj->getLabel();
        }

        return $workFlowStatus;
    }

}
