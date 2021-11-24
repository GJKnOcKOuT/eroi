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

use arter\amos\core\controllers\BaseController;
use arter\amos\core\record\Record;


/**
 * Class UserValidatorContentRule
 * @package arter\amos\core\rules
 */
class UserValidatorContentRule extends DefaultOwnContentRule
{
    /**
     * @inheritdoc
     */
    public $name = 'userValidatorContent';

    /**
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

        }else {
            $controller = \Yii::$app->controller;
            if($controller instanceof BaseController)
            {
                $modelClassName = $controller->getModelClassName();
            }
        }
        if (!isset($cwhModule) || !in_array($modelClassName, $cwhModule->modelsEnabled)) {
            return false;
        } else {
            $permissionCwhValidate = $cwhModule->permissionPrefix. "_VALIDATE_".$modelClassName;
            return $this->userValidatorContentPermission($user, $permissionCwhValidate);
        }
    }

    /**
     * @param int $userId
     * @param string $permissionCwhValidate
     * @return bool
     */
    private function userValidatorContentPermission($userId ,$permissionCwhValidate)
    {
        $cwhContentValidatePerssions = \arter\amos\cwh\models\base\CwhAuthAssignment::find()->andWhere(['user_id' => $userId, 'item_name' => $permissionCwhValidate])->all();
        return (!empty($cwhContentValidatePerssions));
    }
}