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

/**
 */

namespace arter\amos\een\utility;

use arter\amos\admin\models\UserProfile;
use arter\amos\core\user\User;
use arter\amos\een\models\EenStaff;
use arter\amos\een\models\EenExprOfInterest;
use kartik\mpdf\Pdf;
use yii\data\ActiveDataProvider;

class EenUtility
{

    /**
     * Get members of Staff Een
     * @return array UserProfile
     */
    public static function getProfilesStaffEen()
    {
        $staffEeen = UserProfile::find()->innerJoin('een_staff', 'een_staff.user_id = user_profile.user_id')->andWhere([
                'IS', 'een_staff.deleted_at', null])->all();
        return $staffEeen;
    }

    /**
     * @param $userId
     * @return null|array Organizations
     */
    public static function userOrganizationNetwork($userId = null)
    {
        $moduleOrganization = \Yii::$app->getModule('organizations');
        $organizations      = null;
        if (!empty($moduleOrganization)) {
            if ($userId == null) {
                $userId = \Yii::$app->user->id;
            }
            $cwh = \Yii::$app->getModule("cwh");
            if (isset($cwh)) {
                $organizations = \arter\amos\cwh\utility\CwhUtil::getUserNetworkQuery(\openinnovation\organizations\models\Organizations::getCwhConfigId(),
                        $userId, false)->all();
            }
        }
        return $organizations;
    }

    /**
     * @return mixed
     */
    public static function getStaffDefault()
    {
        $staffDefault = EenStaff::find()->andWhere(['staff_default' => 1])->one();
        return $staffDefault;
    }

    /**
     * @param $user_id
     * @return bool
     * @throws \Exception
     */
    public static function setPermissionStaff($user_id)
    {
        if (!\Yii::$app->authManager->checkAccess($user_id, 'STAFF_EEN')) {
            $role = \Yii::$app->authManager->getRole('STAFF_EEN');
            if ($role) {
                \Yii::$app->authManager->assign($role, $user_id);
                return true;
            }
        }
        return false;
    }

    /**
     * @param $user_id
     * @return bool
     */
    public static function deletePermissionStaff($user_id)
    {
        if (\Yii::$app->authManager->checkAccess($user_id, 'STAFF_EEN')) {
            $role = \Yii::$app->authManager->getRole('STAFF_EEN');
            if ($role) {
                \Yii::$app->authManager->revoke($role, $user_id);
                return true;
            }
        }

        return false;
    }

    /**
     * @return array
     */
    public static function getUserStaffEenWithEOI()
    {
        $userIds = [];
        $users   = User::find()
            ->innerJoin('een_staff', 'een_staff.user_id=user.id')
            ->innerJoin('een_expr_of_interest', 'een_expr_of_interest.een_staff_id=een_staff.id')
            ->andWhere(['!=', 'een_expr_of_interest.status', EenExprOfInterest::EEN_EXPR_WORKFLOW_STATUS_CLOSED])
            ->andWhere(['IS', 'een_expr_of_interest.deleted_at', NULL])
            ->andWhere(['IS', 'een_staff.deleted_at', NULL])
            ->all();

        foreach ($users as $user) {
            $userIds [] = $user->id;
        }
        return $userIds;
    }

    /**
     * @return mixed
     */
    public static function getAdminUsers()
    {
        $ids = \Yii::$app->authManager->getUserIdsByRole('ADMINISTRATOR_EEN');
        if (!empty($ids)) {
            $users = User::find()->andWhere(['id' => $ids])->all();
            return $users;
        }
        return null;
    }
}