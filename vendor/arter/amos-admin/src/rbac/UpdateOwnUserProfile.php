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
 * @package    arter\amos\admin\rbac
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\admin\rbac;

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\models\UserProfile;
use yii\rbac\Item;
use yii\rbac\Rule;

/**
 * Class UpdateOwnUserProfile
 * @package arter\amos\admin\rbac
 */
class UpdateOwnUserProfile extends Rule
{
    public $name = 'isYourProfile';
    public $description = '';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        $model = ((isset($params['model']) && $params['model']) ? $params['model'] : new UserProfile());

        if (!$model->id) {
            $post = \Yii::$app->getRequest()->post();
            $get = \Yii::$app->getRequest()->get();

            if (isset($get['id'])) {
                $model = $this->instanceModel($model, $get['id']);
            } elseif (isset($post['id'])) {
                $model = $this->instanceModel($model, $post['id']);
            }
        }

        //INIZIO ACCOPPIAMENTO STRETTO CON ALTRA ENTITA'
        /** @var AmosAdmin $adminModule */
        $adminModule = \Yii::$app->getModule(AmosAdmin::getModuleName());
        if ($adminModule->tightCoupling == true && !\Yii::$app->user->can($adminModule->tightCouplingRoleAdmin)) {
            $tightCouplingModel = null;
            $tightCouplingField = null;
            if (!empty($adminModule->tightCouplingModel) && is_array($adminModule->tightCouplingModel)) {
                foreach ($adminModule->tightCouplingModel as $k => $v) {
                    $tightCouplingModel = $k;
                    $tightCouplingField = $v;
                }
            }

            if (!empty($tightCouplingModel) && !empty($tightCouplingField)) {
                $my = [];
                $myGroups = $tightCouplingModel::find()
                    ->andWhere(['user_id' => $user])
                    ->select($tightCouplingField)
                    ->andWhere(['exclude_from_query' => 1])
                    ->orderBy($tightCouplingField)->asArray()->all();
                $groupUserUpdate = $tightCouplingModel::find()
                    ->andWhere(['user_id' => $model->user_id])
                    ->select($tightCouplingField)
                    ->andWhere(['exclude_from_query' => 1])
                    ->orderBy($tightCouplingField)->asArray()->all();
                foreach ($myGroups as $k => $v) {
                    foreach ($groupUserUpdate as $k1 => $v1) {
                        if ($v[$tightCouplingField] == $v1[$tightCouplingField]) {
                            return true;
                        }
                    }
                }
            }
        }

        //FINE ACCOPPIAMENTO STRETTO CON ALTRA ENTITA'

        return ($model->user_id == $user);
    }

    /**
     * @param UserProfile $model
     * @param int $modelId
     * @return mixed
     */
    private function instanceModel($model, $modelId)
    {
        /** @var UserProfile $userProfileInstance */
        $userProfileInstance = AmosAdmin::instance()->createModel('UserProfile');
        $instancedModel = $userProfileInstance::findOne($modelId);
        if (!is_null($instancedModel)) {
            $model = $instancedModel;
        }
        return $model;
    }
}