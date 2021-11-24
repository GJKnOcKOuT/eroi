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
 * @package    arter\amos\admin\rules
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\admin\rules;

use arter\amos\admin\models\UserProfile;
use arter\amos\core\record\Record;
use yii\rbac\Rule;

/**
 * Class DefaultFacilitatorOwnContentRule
 * @package arter\amos\admin\rules
 */
class DefaultFacilitatorOwnContentRule extends Rule
{
    public $name = 'defaultFacilitatorOwnContent';

    /**
     * @inheritdoc
     */
    public function execute($loggedUserId, $item, $params)
    {
        // If the key "model" non exist return false
        if (!isset($params['model'])) {
            return false;
        }

        /** @var Record $model */
        $model = $params['model'];
        if (!$model->id) {
            $post = \Yii::$app->getRequest()->post();
            $get = \Yii::$app->getRequest()->get();
            if (isset($get['id'])) {
                $model = $this->instanceModel($model, $get['id']);
            } elseif (isset($post['id'])) {
                $model = $this->instanceModel($model, $post['id']);
            }
        }

        // Search content creator
        $contentOwnerObj = UserProfile::findOne(['user_id' => $model->created_by]);
        if (is_null($contentOwnerObj)) {
            return false;
        }

        // Search content creator facilitator
        $contentOwnerFacilitatorObj = UserProfile::find()->andWhere(['OR',
            ['id' => $contentOwnerObj->facilitatore_id],
        ])->one();
        $contentOwnerExternalFacilitatorObj = UserProfile::find()->andWhere(['OR',
            ['id' => $contentOwnerObj->external_facilitator_id],
        ])->one();
        if (is_null($contentOwnerFacilitatorObj) && is_null($contentOwnerExternalFacilitatorObj)) {
            return false;
        }

        // Check if content owner facilitator is the same of the logged user
        return ($contentOwnerFacilitatorObj->user_id == $loggedUserId || $contentOwnerExternalFacilitatorObj->user_id == $loggedUserId);
    }

    /**
     * @param Record $model
     * @param int $modelId
     * @return mixed
     */
    protected function instanceModel($model, $modelId)
    {
        $modelClass = $model->className();
        /** @var Record $modelClass */
        $instancedModel = $modelClass::findOne($modelId);
        if (!is_null($instancedModel)) {
            $model = $instancedModel;
        }
        return $model;
    }
}
