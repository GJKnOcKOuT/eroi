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
 * @package    arter\amos\partnershipprofiles\utility
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\partnershipprofiles\utility;

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\interfaces\OrganizationsModuleInterface as AdminOrgInterface;
use arter\amos\core\interfaces\OrganizationsModuleInterface as CoreOrgInterface;
use arter\amos\partnershipprofiles\models\PartnershipProfiles;
use yii\base\BaseObject;

/**
 * Class ExpressionsOfInterestUtility
 * @package arter\amos\partnershipprofiles\utility
 */
class ExpressionsOfInterestUtility extends BaseObject
{
    /**
     * Check if the logged user is the creator of one of the expressions of interest for a partnership profile.
     * @param PartnershipProfiles $partnershipProfile
     * @return bool
     */
    public static function isPartProfExprsOfIntCreator($partnershipProfile)
    {
        $notDraftExpressionsOfInterest = $partnershipProfile->notDraftExpressionsOfInterest;
        $isCreator = false;
        $loggedUserId = \Yii::$app->user->id;
        foreach ($notDraftExpressionsOfInterest as $expressionOfInterest) {
            if ($expressionOfInterest->created_by == $loggedUserId) {
                $isCreator = true;
            }
        }
        return $isCreator;
    }

    /**
     * Check if the logged user is the creator facilitator of one of the expressions of interest for a partnership profile.
     * @param PartnershipProfiles $partnershipProfile
     * @return bool
     */
    public static function isPartProfExprsOfIntCreatorFacilitator($partnershipProfile)
    {
        $notDraftExpressionsOfInterest = $partnershipProfile->notDraftExpressionsOfInterest;
        $isCreator = false;
        $loggedUserId = \Yii::$app->user->id;
        foreach ($notDraftExpressionsOfInterest as $expressionOfInterest) {
            if ($expressionOfInterest->createdUserProfile->facilitatore->user_id == $loggedUserId) {
                $isCreator = true;
            }
        }
        return $isCreator;
    }

    /**
     * @return array
     */
    public static function getReferenceCommunityOrOrganizationList()
    {
        $listData = [];
        $moduleCwh = \Yii::$app->getModule('cwh');
        if (!is_null($moduleCwh)) {
            /** @var \arter\amos\cwh\AmosCwh $moduleCwh */
            /** @var AmosAdmin $moduleAdmin */
            $moduleAdmin = \Yii::$app->getModule('admin');
            $moduleOrganizations = \Yii::$app->getModule($moduleAdmin->getOrganizationModuleName());
            if (!is_null($moduleOrganizations) && (($moduleOrganizations instanceof AdminOrgInterface) || ($moduleOrganizations instanceof CoreOrgInterface))) {
                /** @var AdminOrgInterface|CoreOrgInterface $moduleOrganizations */
                $organizationsModelClassName = $moduleOrganizations->getOrganizationModelClass();
                $organizationsCwhConfigId = $organizationsModelClassName::getCwhConfigId();
                $query = \arter\amos\cwh\utility\CwhUtil::getUserNetworkQuery($organizationsCwhConfigId, \Yii::$app->user->id, false);
                if (!is_null($query)) {
                    $tmpModels = $query->orderBy([$organizationsModelClassName::tableName() . '.name' => SORT_ASC])->all();
                    foreach ($tmpModels as $tmpModel) {
                        $id = $organizationsModelClassName::tableName() . '-' . $tmpModel->id;
                        $listData[$id] = $tmpModel->name;
                    }
                }
            }
            $moduleCommunity = \Yii::$app->getModule('community');
            if (!is_null($moduleCommunity)) {
                /** @var \arter\amos\community\AmosCommunity $moduleCommunity */
                $communityCwhConfigId = \arter\amos\community\models\Community::getCwhConfigId();
                $query = \arter\amos\cwh\utility\CwhUtil::getUserNetworkQuery($communityCwhConfigId, \Yii::$app->user->id, true);
                if (!is_null($query)) {
                    $tmpModels = $query->orderBy([\arter\amos\community\models\Community::tableName() . '.name' => SORT_ASC])->all();
                    foreach ($tmpModels as $tmpModel) {
                        $id = \arter\amos\community\models\Community::tableName() . '-' . $tmpModel->id;
                        $listData[$id] = $tmpModel->name;
                    }
                }
            }
        }
        return $listData;
    }

    /**
     * @return bool
     */
    public static function viewCommunityOrOrganizationList()
    {
        return (count(self::getReferenceCommunityOrOrganizationList()) > 0);
    }

    /**
     * @return mixed|null
     */
    public static function getOnlyOneOrganization()
    {
    $moduleCwh = \Yii::$app->getModule('cwh');
    if (!is_null($moduleCwh)) {
        /** @var \arter\amos\cwh\AmosCwh $moduleCwh */
        /** @var AmosAdmin $moduleAdmin */
        $moduleAdmin = \Yii::$app->getModule('admin');
        $moduleOrganizations = \Yii::$app->getModule($moduleAdmin->getOrganizationModuleName());
        if (!is_null($moduleOrganizations) && (($moduleOrganizations instanceof AdminOrgInterface) || ($moduleOrganizations instanceof CoreOrgInterface))) {
            /** @var AdminOrgInterface|CoreOrgInterface $moduleOrganizations */
            $organizationsModelClassName = $moduleOrganizations->getOrganizationModelClass();
            $organizationsCwhConfigId = $organizationsModelClassName::getCwhConfigId();
            $query = \arter\amos\cwh\utility\CwhUtil::getUserNetworkQuery($organizationsCwhConfigId, \Yii::$app->user->id, false);
            if (!is_null($query)) {
                $tmpModel = $query->orderBy([$organizationsModelClassName::tableName() . '.name' => SORT_ASC])->one();
                    if($tmpModel) {
                        return $tmpModel;
                    }
                }
            }
        }
        return null;
    }
}
