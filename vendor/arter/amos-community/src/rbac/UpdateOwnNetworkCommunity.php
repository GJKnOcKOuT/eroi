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
 * @package    arter\amos\community
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\community\rbac;

use arter\amos\community\AmosCommunity;
use arter\amos\community\models\Community;
use yii\rbac\Item;
use yii\rbac\Rule;

/**
 * Class UpdateOwnUserProfile
 * @package arter\amos\community\rbac
 */
class UpdateOwnNetworkCommunity extends Rule
{
    public $name = 'isCommunityInYourNetwork';
    public $description = '';

    public function execute($user, $item, $params)
    {
        /** @var Community $model */
        $model = ((isset($params['model']) && $params['model']) ? $params['model'] : new Community());

        if (!isset($model->id)) {
            $post = \Yii::$app->getRequest()->post();
            $get = \Yii::$app->getRequest()->get();
            if (isset($get['id'])) {
                $model = $this->instanceModel($model, $get['id']);
            } elseif (isset($post['id'])) {
                $model = $this->instanceModel($model, $post['id']);
            }
        }

        if (($model instanceof Community)) {
            if (!empty($model->getWorkflowStatus())) {
                if (($model->getWorkflowStatus()->getId() == Community::COMMUNITY_WORKFLOW_STATUS_TO_VALIDATE && $model->validated_once !=1 ) && !(\Yii::$app->user->can('COMMUNITY_VALIDATOR', ['model' => $model]))) {
                    return false;
                }
            }
            return $model->isNetworkUser($model->id, $user);
        }
        return false;
    }

    /**
     * @param Community $model
     * @param int $modelId
     * @return mixed
     */
    private function instanceModel($model, $modelId)
    {
        /** @var UserProfile $userProfileInstance */
        $userProfileInstance = AmosCommunity::instance()->createModel('Community');
        $instancedModel = $userProfileInstance::findOne($modelId);

        if (!is_null($instancedModel)) {
            $model = $instancedModel;
        }

        return $model;
    }
}
