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
 * @package    arter\amos\myactivities\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\myactivities\widgets;

use arter\amos\admin\models\UserProfile;
use arter\amos\core\exceptions\AmosException;
use arter\amos\core\interfaces\WorkflowModelInterface;
use arter\amos\core\record\Record;
use arter\amos\myactivities\AmosMyActivities;
use arter\amos\myactivities\basic\MyActivitiesModelsInterface;
use arter\amos\workflow\behaviors\WorkflowLogFunctionsBehavior;
use yii\base\Widget;

/**
 * Class UserRequestValidation
 * @package arter\amos\myactivities\widgets
 */
class UserRequestValidation extends Widget
{
    /**
     * @var Record|MyActivitiesModelsInterface $model
     */
    public $model;

    /**
     * @var string $labelKey - label for activity title translation
     */
    public $labelKey;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (!($this->model instanceof MyActivitiesModelsInterface)) {
            throw new AmosException(AmosMyActivities::t('amosmyactivities', 'UserRequestValidation: object not instance of MyActivitiesModelsInterface'));
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        /** @var WorkflowLogFunctionsBehavior|WorkflowModelInterface $model */
        $model = $this->model->getWrappedObject();
        $workflowModule = \Yii::$app->getModule('workflow');
        if ($workflowModule) {
            $userId = $model->getStatusLastUpdateUser($model->getToValidateStatus());
            $validationRequestTime = $model->getStatusLastUpdateTime($model->getToValidateStatus());
        }
        if (is_null($userId)) {
            $userId = $model->updated_by;
            if (is_null($userId)) {
                $userId = $model->created_by;
            }
            if (is_null($userId)) {
                $userId = $model->user_id;
            }
            $validationRequestTime = $model->updated_at;
            if (is_null($validationRequestTime)) {
                $validationRequestTime = $model->created_at;
            }
        }
        if (!is_null($userId)) {
            $userProfile = UserProfile::find()->andWhere(['user_id' => $userId])->one();
            if (!is_null($userProfile)) {
                return $this->render('user_request_validation', [
                    'userProfile' => $userProfile,
                    'model' => $this->model,
                    'validationRequestTime' => $validationRequestTime,
                    'labelKey' => $this->labelKey
                ]);
            }
        }
        return '';
    }
}
