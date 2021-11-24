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
 * @package    arter\amos\partnershipprofiles\events
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\partnershipprofiles\events;

use arter\amos\partnershipprofiles\models\ExpressionsOfInterest;
use arter\amos\partnershipprofiles\models\PartnershipProfiles;
use yii\base\Event;
use yii\base\BaseObject;

/**
 * Class PartnershipProfilesWorkflowEvent
 * @package arter\amos\partnershipprofiles\events
 */
class PartnershipProfilesWorkflowEvent extends BaseObject
{
    /**
     * @param \yii\base\Event $yiiEvent
     * @return bool
     */
    public function updatePartnershipProfileStatus(Event $yiiEvent)
    {
        /** @var ExpressionsOfInterest $expressionOfInterest */
        $expressionOfInterest = $yiiEvent->data;
        $partnershipProfile = $expressionOfInterest->partnershipProfile;
        $ok = true;
        if ($partnershipProfile->status == PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_VALIDATED) {
            $partnershipProfile->sendToStatus(PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_FEEDBACKRECEIVED);
            $ok = $partnershipProfile->save(false);
        }
        return $ok;
    }
}
