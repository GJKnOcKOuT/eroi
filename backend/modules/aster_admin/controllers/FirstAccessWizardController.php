<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_admin\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\aster_admin\controllers;

use backend\modules\aster_admin\components\FirstAccessWizardParts;
use backend\modules\aster_admin\models\UserProfile;
use backend\modules\aster_admin\utility\UserProfileUtility;
use arter\amos\admin\AmosAdmin;
use arter\amos\admin\controllers\FirstAccessWizardController as AmosFirstAccessWizardController;
use arter\amos\admin\models\search\UserProfileRoleSearch;
use arter\amos\core\utilities\ArrayUtility;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Url;

/**
 * Class FirstAccessWizardController
 *
 * @property UserProfile $model
 *
 * @package backend\modules\aster_admin\controllers
 */
class FirstAccessWizardController extends AmosFirstAccessWizardController
{
    /**
     * Set view params for the event creation wizard.
     */
    private function setParamsForView()
    {
        $parts = new FirstAccessWizardParts(['model' => $this->model]);
        Yii::$app->view->title = $parts->active['index'] . '. ' . $parts->active['label'];
        Yii::$app->view->params['model'] = $this->model;
        Yii::$app->view->params['partsQuestionario'] = $parts;
        Yii::$app->view->params['hidePartsLabel'] = true; // This param hide the second title under the wizard progress bar.
        Yii::$app->view->params['disablePlatformLinks'] = true;
        Yii::$app->view->params['hideBreadcrumb'] = true; // This param hide the breadcrumb in the wizard layout.
        Yii::$app->view->params['hidePartsUrl'] = true; // This param disable the progress wizard menu links.
    }

    /**
     * @inheritdoc
     */
    public function goToNextPart()
    {
        $parts = new FirstAccessWizardParts(['model' => $this->model]);

        return $this->redirect([$parts->getNext()]);
    }

    /**
     * @inheritdoc
     */
    public function actionIntroduction()
    {
        Url::remember();

        $this->model = $this->findModel($this->userProfileId);
        $this->model->setScenario(UserProfile::SCENARIO_INTRODUCTION);
        if (Yii::$app->getRequest()->post()) {
            return $this->goToNextPart();
        }

        // If the user has never accessed to the first access wizard, this will create a new array (jsonified)
        // that will be saved in the db and saves the steps opened once at least
        if ($this->model->first_access_wizard_steps_accessed == "") {
            $parts = [];
            $firstAccessWizardParts = (new FirstAccessWizardParts(['model' => $this->model]));
            foreach ($firstAccessWizardParts::$map as $partName => $partValue) {
                $parts[$partName] = false;
            }

            $this->model->first_access_wizard_steps_accessed = Json::encode($parts);
            $this->model->save(false);
        }

        $this->setAccessFirstTime(FirstAccessWizardParts::PART_INTRODUCTION);

        $this->setParamsForView();

        return $this->render(
            'introduction',
            [
                'model' => $this->model
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function actionIntroducingMyself()
    {
        Url::remember();

        $this->model = $this->findModel($this->userProfileId);
        // Set default facilitator if an other facilitator is not present.
        if (!$this->model->facilitatore_id && !is_null($this->model->getDefaultFacilitator())) {
            $this->model->facilitatore_id = $this->model->getDefaultFacilitator()->id;
            $this->model->save(false);
        }

        $this->model->setScenario(UserProfile::SCENARIO_INTRODUCING_MYSELF);
        if (Yii::$app->getRequest()->post() && $this->model->load(Yii::$app->getRequest()->post()) && $this->model->save()) {
            if(!empty(\Yii::$app->request->get('gotoFacilitator'))){
                return $this->redirect(['/admin/first-access-wizard/associate-facilitator', 'id' => $this->model->id, 'viewM2MWidgetGenericSearch' => true]);
            }
            return $this->goToNextPart();
        }

        $this->setAccessFirstTime(FirstAccessWizardParts::PART_INTRODUCING_MYSELF);

        $this->setParamsForView();

        return $this->render(
            'introducing_myself',
            [
                'model' => $this->model,
                'facilitatorUserProfile' => $this->model->facilitatore
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function actionRoleAndArea()
    {
        Url::remember();

        $this->model = $this->findModel($this->userProfileId);

        if (Yii::$app->getRequest()->post()) {
            $this->model->setScenario(UserProfile::SCENARIO_ROLE_AND_AREA);
            if ($this->model->load(Yii::$app->getRequest()->post()) && $this->model->save()) {
                return $this->goToNextPart();
            }
        }

        $this->setAccessFirstTime(FirstAccessWizardParts::PART_ROLE_AND_AREA);

        $this->setParamsForView();
        $this->model->setScenario(UserProfile::SCENARIO_ROLE_AND_AREA);

        return $this->render(
            'role_and_area',
            [
                'model' => $this->model
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function actionInterests()
    {
        Url::remember();

        $this->model = $this->findModel($this->userProfileId);

        if (Yii::$app->getRequest()->post()) {
            $this->model->setScenario(UserProfile::SCENARIO_INTERESTS);
            if ($this->model->load(Yii::$app->getRequest()->post()) && $this->model->save()) {
                return $this->goToNextPart();
            }
        }

        if ($this->model->hasErrors()) {
            foreach ($this->model->getErrors() as $errors) {
                foreach ($errors as $error) {
                    Yii::$app->getSession()->addFlash('danger', $error);
                }
            }
        }

        $this->setAccessFirstTime(FirstAccessWizardParts::PART_INTERESTS);

        $this->setParamsForView();
        $this->model->setScenario(UserProfile::SCENARIO_INTERESTS);

        return $this->render(
            'interests',
            [
                'model' => $this->model
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function actionPartnership()
    {
        Url::remember();

        $this->model = $this->findModel($this->userProfileId);

        if (Yii::$app->getRequest()->post()) {
            $this->model->setScenario(UserProfile::SCENARIO_PARTNERSHIP);
            if ($this->model->load(Yii::$app->getRequest()->post()) && $this->model->save()) {
                return $this->goToNextPart();
            }
        }

        $this->setAccessFirstTime(FirstAccessWizardParts::PART_PARTNERSHIP);

        $this->setParamsForView();
        $this->model->setScenario(UserProfile::SCENARIO_PARTNERSHIP);

        return $this->render(
            'partnership',
            [
                'model' => $this->model
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function actionFinish()
    {
        Url::remember();
        $this->model = $this->findModel($this->userProfileId);

        $this->model->status = ($this->adminModule->bypassWorkflow ?
            UserProfile::USERPROFILE_WORKFLOW_STATUS_VALIDATED :
            UserProfile::USERPROFILE_WORKFLOW_STATUS_TOVALIDATE);
        $this->model->save(false);

        UserProfileUtility::updateUserProfileOnChangeMentor($this->model);
        $this->setAccessFirstTime(FirstAccessWizardParts::PART_FINISH);

        $this->setParamsForView();

        return $this->render(
            'finish',
            [
                'model' => $this->model
            ]
        );
    }
    
    /**
     * @inheritdoc
     */
    public function getRoles()
    {
        return ArrayUtility::translateArrayValues(
            ArrayHelper::map(UserProfileRoleSearch::searchAll(), 'id', 'name'),
            'amosadmin',
            AmosAdmin::className()
        );
    }
}
