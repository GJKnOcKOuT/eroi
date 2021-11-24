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
 * @package    arter\amos\core\rules
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\rules;


class UserCreatorContentOnDomain extends DefaultOwnContentRule
{
    /**
     * @inheritdoc
     */
    public $name = 'userCreatorContentOnDomain';

    /**
     * @deprecated
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        $modelClassName = '';
        $cwhModule = \Yii::$app->getModule('cwh');
        if (isset($params['model'])) {
            /** @var Record $model */
            $model = $params['model'];
            $modelClassName = $model->className();

            if (!$model->id) {
                $post = \Yii::$app->getRequest()->post();
                $get = \Yii::$app->getRequest()->get();
                if (isset($get['id'])) {
                    $model = $this->instanceModel($model, $get['id']);
                } elseif (isset($post['id'])) {
                    $model = $this->instanceModel($model, $post['id']);
                }
            }
        } else {
            $controller = \Yii::$app->controller;
            if ($controller instanceof BaseController) {
                $modelClassName = $controller->getModelClassName();
            }
        }
        if (!isset($cwhModule) || !in_array($modelClassName, $cwhModule->modelsEnabled)) {
            return false;
        } else {
            $scope = $cwhModule->getCwhScope();
            if (empty($scope)) {
                return false;
            }
            $permissionCwhCreate = $cwhModule->permissionPrefix . "_CREATE_" . $modelClassName;
            $networkKeys = array_keys($scope);
            $allow = true;
            foreach ($networkKeys as $networkKey) {
                $networkConfig = \arter\amos\cwh\models\CwhConfig::findOne(['tablename' => $networkKey]);
                if (is_null($networkConfig)) {
                    $allow = false;
                } else {
                    $networkId = $scope[$networkKey];
                    $allow = $allow && $this->userCreatorContentPermission($user, $permissionCwhCreate,
                            $networkConfig->id, $networkId);
                }
            }
            return $allow;
        }
    }

    /**
     * @param int $userId
     * @param string $permissionCwhCreate
     * @param int $networkConfigId - id of network configuration (cwh_config table)
     * @param int $networkId - id of the network (eg. community, organization user is working within)
     * @return bool
     */
    private function userCreatorContentPermission($userId, $permissionCwhCreate, $networkConfigId, $networkId)
    {

        $cwhContentCreatePerssions = \arter\amos\cwh\models\base\CwhAuthAssignment::findOne([
            'user_id' => $userId,
            'item_name' => $permissionCwhCreate,
            'cwh_config_id' => $networkConfigId,
            'cwh_network_id' => $networkId
        ]);
        return (!is_null($cwhContentCreatePerssions));
    }
}