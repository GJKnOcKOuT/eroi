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

namespace arter\amos\invitations\rules;

use arter\amos\invitations\models\Invitation;
use yii\rbac\Rule;

class ReadOwnInvitationRule extends Rule
{
    public $name = 'readOwnInvitation';

    /**
     * @inheritdoc
     */
    public function execute($loggedUserId, $item, $params)
    {

        // If the key "model" non exist return false
        if (!isset($params['model'])) {
            return true;
        }

        /** @var Invitation $model */
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

        if ($model->isNewRecord) {
            return true;
        }

        return ($model->created_by == $loggedUserId);
    }

    /**
     * @param Invitation $model
     * @param int $modelId
     * @return mixed
     */
    protected function instanceModel($model, $modelId)
    {
        $modelClass = $model->className();
        /** @var \arter\amos\invitations\models\Invitation $modelClass */
        $instancedModel = $modelClass::findOne($modelId);
        if (!is_null($instancedModel)) {
            $model = $instancedModel;
        }
        return $model;
    }
}