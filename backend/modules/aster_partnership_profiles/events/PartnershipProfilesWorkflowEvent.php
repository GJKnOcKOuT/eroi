<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_partnership_profiles\events
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\aster_partnership_profiles\events;

use arter\amos\partnershipprofiles\models\PartnershipProfiles;
use yii\base\Event;
use yii\base\BaseObject;

/**
 * Class PartnershipProfilesWorkflowEvent
 * @package backend\modules\aster_partnership_profiles\events
 */
class PartnershipProfilesWorkflowEvent extends \arter\amos\partnershipprofiles\events\PartnershipProfilesWorkflowEvent {

    public function sendEmailtoMentorOfEroe(Event $yiiEvent) {
        /** @var PartnershipProfiles $partnershipProfile */
        $partnershipProfile = $yiiEvent->data;
        \backend\modules\aster_partnership_profiles\utility\PartnershipProfilesUtility::sendEmailIToMentorEroe($partnershipProfile);
        return true;
    }

    public function sendEmailIToMentorSfide(Event $yiiEvent) {
        /** @var PartnershipProfiles $partnershipProfile */
        $partnershipProfile = $yiiEvent->data;
        \backend\modules\aster_partnership_profiles\utility\PartnershipProfilesUtility::sendEmailIToMentorSfide($partnershipProfile);
        return true;
    }

    public function sendEmailIToCMSfide(Event $yiiEvent) {
        /** @var PartnershipProfiles $partnershipProfile */
        $partnershipProfile = $yiiEvent->data;
        \backend\modules\aster_partnership_profiles\utility\PartnershipProfilesUtility::sendEmailIToCMSfide($partnershipProfile);
        return true;
    }

    public function sendEmailIToCMSfideToValidate(Event $yiiEvent) {
        /** @var PartnershipProfiles $partnershipProfile */
        $partnershipProfile = $yiiEvent->data;
        \backend\modules\aster_partnership_profiles\utility\PartnershipProfilesUtility::sendEmailIToCMSfideToValidate($partnershipProfile);
        return true;
    }
    
     public function sendEmailIToAnimatorSfide(Event $yiiEvent) {
        /** @var PartnershipProfiles $partnershipProfile */
        $partnershipProfile = $yiiEvent->data;
        \backend\modules\aster_partnership_profiles\utility\PartnershipProfilesUtility::sendEmailIToAnimatorSfide($partnershipProfile);
        return true;
    }


}
