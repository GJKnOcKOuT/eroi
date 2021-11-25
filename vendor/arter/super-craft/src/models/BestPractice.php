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


namespace arter\amos\best\practice\models;

use arter\amos\attachments\behaviors\FileBehavior;
use arter\amos\best\practice\i18n\grammar\BestPracticeGrammar;
use arter\amos\best\practice\Module;
use arter\amos\community\utilities\CommunityUtil;
use arter\amos\workflow\behaviors\WorkflowLogFunctionsBehavior;
use raoul2000\workflow\base\SimpleWorkflowBehavior;
use yii\helpers\ArrayHelper;


/**
 * Class BestPractice
 * This is the model class for table "best_practice".
 *
 * @method \yii\db\ActiveQuery hasMultipleFiles($attribute = 'file', $sort = 'id')
 * @package arter\amos\best\practice\models
 */
class BestPractice extends \arter\amos\best\practice\models\base\BestPractice
{
    // Workflow ID
    const BESTPRACTICE_WORKFLOW = 'BestPracticeWorkflow';

    // Workflow states IDS
    const BESTPRACTICE_WORKFLOW_STATUS_DRAFT = 'BestPracticeWorkflow/DRAFT';
    const BESTPRACTICE_WORKFLOW_STATUS_TOVALIDATE = 'BestPracticeWorkflow/TOVALIDATE';
    const BESTPRACTICE_WORKFLOW_STATUS_VALIDATED = 'BestPracticeWorkflow/VALIDATED';

    /**
     * @var $attachments
     */
    private $bestPracticeAttachments;

    /**
     * @inheritdoc
     */
    public function representingColumn()
    {
        return [
            'title'
        ];
    }

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['bestPracticeAttachments'], 'file', 'maxFiles' => 0],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),
            [
                'workflow' => [
                    'class' => SimpleWorkflowBehavior::className(),
                    'defaultWorkflowId' => self::BESTPRACTICE_WORKFLOW,
                    'propagateErrorsToModel' => true
                ],
                'fileBehavior' => [
                    'class' => FileBehavior::className()
                ],
                'workflowLog' => [
                    'class' => WorkflowLogFunctionsBehavior::className(),
                ]
            ]);
    }

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @inheritdoc
     */
    public function getDescription($truncate)
    {
        return $this->synthesis;
    }

    /**
     * @inheritdoc
     */
    public function getGridViewColumns()
    {
        return [

            'titolo' => [
                'attribute' => 'title',
                'headerOptions' => [
                    'id' => Module::t('amosbestpractice', 'title'),
                ],
                'contentOptions' => [
                    'headers' => Module::t('amosbestpractice', 'title'),
                ],
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    /** @var BestPractice $model */
                    return $model->hasWorkflowStatus() ? Module::t('amosbestpractice', $model->getWorkflowStatus()->getLabel()) : '--';
                }
            ],
            'created_by' => [
                'attribute' => 'createdUserProfile',
                'headerOptions' => [
                    'id' => Module::t('amosbestpractice', 'created by'),
                ],
                'contentOptions' => [
                    'headers' => Module::t('amosbestpractice', 'created by'),
                ]
            ],
            'created_at' => [
                'attribute' => 'created_at',
                'format' => 'date',
                'headerOptions' => [
                    'id' => Module::t('amosbestpractice', 'created at'),
                ],
                'contentOptions' => [
                    'headers' => Module::t('amosbestpractice', 'created at'),
                ]
            ],

        ];
    }

    public function getAvatarUrl($dimension = 'original')
    {
        if ($this->sesso == 'Maschio') {
            $url = \Yii::$app->getUrlManager()->createAbsoluteUrl(Url::to('/img/defaultProfiloM.png'));
        } elseif ($this->sesso == 'Femmina') {
            $url = \Yii::$app->getUrlManager()->createAbsoluteUrl(Url::to('/img/defaultProfiloF.png'));
        } else {
            $url = \Yii::$app->getUrlManager()->createAbsoluteUrl(Url::to('/img/defaultProfilo.png'));
        }

        if (!empty($this->getUserProfileImage())) {
            $url = $this->userProfileImage->getUrl($dimension, false, true);
        }

        return $url;
    }

    /**
     * @inheritdoc
     */
    public function getModelModuleName()
    {
        return Module::getModuleName();
    }

    /**
     * @inheritdoc
     */
    public function getToValidateStatus()
    {
        return self::BESTPRACTICE_WORKFLOW_STATUS_TOVALIDATE;
    }

    /**
     * @inheritdoc
     */
    public function getValidatedStatus()
    {
        return self::BESTPRACTICE_WORKFLOW_STATUS_VALIDATED;
    }

    /**
     * @inheritdoc
     */
    public function getDraftStatus()
    {
        return self::BESTPRACTICE_WORKFLOW_STATUS_DRAFT;
    }

    /**
     * @inheritdoc
     */
    public function getValidatorRole()
    {
        return strtoupper('BESTPRACTICE_VALIDATOR');
    }

    /**
     * @return BestPracticeGrammar
     */
    public function getGrammar()
    {
        return new BestPracticeGrammar();
    }

    /**
     * Getter for $this->attachments;
     *
     */
    public function getBestPracticeAttachments()
    {
        if (empty($this->bestpracticeAttachments)) {
            $this->bestPracticeAttachments = $this->hasMultipleFiles('bestPracticeAttachments')->one();
        }
        return $this->bestPracticeAttachments;
    }

    /**
     * @param $attachments
     */
    public function setBestPracticeAttachments($attachments)
    {
        $this->bestPracticeAttachments = $attachments;
    }

    /**
     * @return array
     */
    public function getStatusToRenderToHide()
    {
        $statusToRender = [
            self::BESTPRACTICE_WORKFLOW_STATUS_DRAFT => Module::t('amosbestpractice', 'Modifica in corso'),
        ];
        $isCommunityManager = false;
        if (!is_null(\Yii::$app->getModule('community'))) {
            $isCommunityManager = CommunityUtil::isLoggedCommunityManager();
            if ($isCommunityManager) {
                $isCommunityManager = true;
            }
        }
        // if you are a community manager a validator/facilitator or ADMIN you Can publish directly
        if (\Yii::$app->user->can('BestPracticeValidate', ['model' => $this]) || \Yii::$app->user->can('ADMIN') || $isCommunityManager) {
            $statusToRender = ArrayHelper::merge($statusToRender, [self::BESTPRACTICE_WORKFLOW_STATUS_VALIDATED => Module::t('amossuggestions', 'Pubblicata')]);
            $hideDraftStatus = [];
        } else {
            $statusToRender = ArrayHelper::merge($statusToRender, [
                self::BESTPRACTICE_WORKFLOW_STATUS_TOVALIDATE => Module::t('amossuggestions', 'Richiedi pubblicazione'),
            ]);
            $hideDraftStatus[] = self::BESTPRACTICE_WORKFLOW_STATUS_VALIDATED;
        }
        return ['statusToRender' => $statusToRender, 'hideDraftStatus' => $hideDraftStatus];
    }
}
