<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_partnership_profiles\rules
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\aster_partnership_profiles\rules;

use arter\amos\core\rules\BasicContentRule;
use arter\amos\partnershipprofiles\models\PartnershipProfiles;

/**
 * Class ArterPartnershipProfilesCloseStatusRule
 * @package backend\modules\aster_partnership_profiles\rules
 */
class ArterPartnershipProfilesCloseStatusRule extends BasicContentRule
{
    public $name = 'arterPartnershipProfilesCloseStatus';
    
    /**
     * @inheritdoc
     */
    public function ruleLogic($user, $item, $params, $model)
    {
        $canClose = false;
        
        if ($model instanceof PartnershipProfiles) {
            /** @var PartnershipProfiles $model */
            $allowedUserIds = [
                $model->created_by
            ];
            $facilitator = $model->partnershipProfileFacilitator;
            if (!is_null($facilitator)) {
                $allowedUserIds[] = $facilitator->user_id;
            }
            $allowedStates = [
                PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_VALIDATED,
                PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_FEEDBACKRECEIVED
            ];
            $canClose = (
                in_array($user, $allowedUserIds) &&
                in_array($model->status, $allowedStates)
            );
        }
        
        return $canClose;
    }
}
