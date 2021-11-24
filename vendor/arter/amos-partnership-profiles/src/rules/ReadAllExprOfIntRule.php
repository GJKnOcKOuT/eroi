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
 * @package    arter\amos\partnershipprofiles\rules
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\partnershipprofiles\rules;

use arter\amos\core\rules\BasicContentRule;
use arter\amos\partnershipprofiles\models\ExpressionsOfInterest;
use arter\amos\partnershipprofiles\models\PartnershipProfiles;

/**
 * Class ReadAllExprOfIntRule
 * @package arter\amos\partnershipprofiles\rules
 */
class ReadAllExprOfIntRule extends BasicContentRule
{
    public $name = 'ReadAllExprOfInt';

    /**
     * Rule to see the link "see all" Expression of interest
     * @inheritdoc
     */
    public function ruleLogic($user, $item, $params, $model)
    {
        /** @var PartnershipProfiles $model */

        if (!is_null($model->partnershipProfileFacilitator) && ($user == $model->partnershipProfileFacilitator->user_id)) {
            // Can see "see all" the facilitator of the PartnershipProfile
            return true;
        } else if ($model->created_by == $user) {
            // Can see "see all" the creator of the PartnershipProfile
            return true;
        } else {
            // Can see "see all" if you are creator of a EOI or if you are FACILITATOR of the creator of EOI
            $exprOfIntList = $model->notDraftExpressionsOfInterest;
            foreach ($exprOfIntList as $exprOfInterest) {
                /** @var ExpressionsOfInterest $exprOfInterest */
                if ($exprOfInterest->created_by == $user) {
                    return true;
                }
                $facilitator = $exprOfInterest->createdUserProfile->facilitatore;
                if (!is_null($facilitator) && ($facilitator->user_id == $user)) {
                    return true;
                }
            }
        }
        return false;
    }
}
