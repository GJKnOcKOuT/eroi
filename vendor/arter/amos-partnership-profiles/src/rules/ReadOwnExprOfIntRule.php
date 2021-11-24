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
 * Class ReadOwnExprOfIntRule
 * @package arter\amos\partnershipprofiles\rules
 */
class ReadOwnExprOfIntRule extends BasicContentRule
{
    public $name = 'readOwnExprOfInt';

    /**
     * @inheritdoc
     */
    public function ruleLogic($user, $item, $params, $model)
    {
        // Default to true for lists
        $canRead = true;

        if (($model instanceof ExpressionsOfInterest) && $model->id) {
            /** @var ExpressionsOfInterest $model */
            $canRead = false;
            $allowedStates = [
                PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_VALIDATED,
                PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_FEEDBACKRECEIVED,
                PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_ARCHIVED,
                PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_CLOSED
            ];

            if (in_array($model->partnershipProfile->status, $allowedStates)) {
                if ($user == $model->created_by) {
                    // Check if user is the expression of interest creator
                    $canRead = true;
                } elseif (!is_null($model->createdUserProfile->facilitatore) && ($user == $model->createdUserProfile->facilitatore->user_id)) {
                    // Check if user is the facilitator of the expression of interest creator
                    $canRead = true;
                } elseif ($user == $model->partnershipProfile->created_by) {
                    // Check if user is the creator of the expression of interest related partnership profile
                    $canRead = true;
                } elseif (!is_null($model->partnershipProfile->partnershipProfileFacilitator) && ($user == $model->partnershipProfile->partnershipProfileFacilitator->user_id)) {
                    // Check if user is the facilitator of the expression of interest related partnership profile
                    $canRead = true;
                }
            }
        }

        return $canRead;
    }
}
