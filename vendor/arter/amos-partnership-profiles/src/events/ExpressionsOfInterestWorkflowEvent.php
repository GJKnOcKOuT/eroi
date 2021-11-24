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

use arter\amos\core\controllers\CrudController;
use arter\amos\partnershipprofiles\models\ExpressionsOfInterest;
use arter\amos\partnershipprofiles\Module;
use arter\amos\partnershipprofiles\utility\PartnershipProfilesEmailUtility;
use yii\base\Event;
use yii\base\BaseObject;

/**
 * Class ExpressionsOfInterestWorkflowEvent
 * @package arter\amos\partnershipprofiles\events
 */
class ExpressionsOfInterestWorkflowEvent extends BaseObject
{
    /**
     * @param Event $yiiEvent
     * @return bool
     */
    public function sendConfirmToPartnershipProfileCreator(Event $yiiEvent)
    {
        /** @var ExpressionsOfInterest $expressionOfInterest */
        $expressionOfInterest = $yiiEvent->data;
        /** @var CrudController $controller */
        $controller = \Yii::$app->controller;
        $toEmails = [$expressionOfInterest->partnershipProfile->createdUserProfile->user->email];
        $bccEmails = $this->getCCEmails($expressionOfInterest);
        $contentView = "@vendor/arter/amos-partnership-profiles/src/views/expressions-of-interest/email/creation_content";
        $subject = $controller->renderMailPartial($contentView . "_subject");
        $text = $controller->renderMailPartial($contentView, [
            'expressionOfInterest' => $expressionOfInterest
        ]);
        $ok = PartnershipProfilesEmailUtility::sendMail(null, $toEmails, $subject, $text, [], $bccEmails);
        return $ok;
    }

    /**
     * @param ExpressionsOfInterest $expressionOfInterest
     * @return array
     */
    private function getCCEmails($expressionOfInterest)
    {
        $bccEmails = [];
        if (!is_null($expressionOfInterest->partnershipProfile->partnershipProfileFacilitator)) {
            $bccEmails[] = $expressionOfInterest->partnershipProfile->partnershipProfileFacilitator->user->email;
        }
        if (!is_null($expressionOfInterest->createdUserProfile->facilitatore)) {
            $bccEmails[] = $expressionOfInterest->createdUserProfile->facilitatore->user->email;
        }
        return $bccEmails;
    }

    /**
     * @param Event $yiiEvent
     * @return bool
     */
    public function sendNotifyToExpressionsOfInterestCreator(Event $yiiEvent)
    {
        /** @var ExpressionsOfInterest $expressionOfInterest */
        $expressionOfInterest = $yiiEvent->data;
        $toEmails = [$expressionOfInterest->createdUserProfile->user->email];
        $bcc = [$expressionOfInterest->partnershipProfile->createdUserProfile->user->email];
        $subjectPart = '';
        $relevantStr = '';
        switch ($expressionOfInterest->status) {
            case ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW_STATUS_TOVALIDATE:
                $subjectPart = Module::t('amospartnershipprofiles', '#in_validation_mail');
                $relevantStr = Module::t('amospartnershipprofiles', 'is examining');
                break;
            case ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW_STATUS_RELEVANT:
                $subjectPart = Module::t('amospartnershipprofiles', '#relevant_mail');
                $relevantStr = Module::t('amospartnershipprofiles', 'considers');
                break;
            case ExpressionsOfInterest::EXPRESSIONS_OF_INTEREST_WORKFLOW_STATUS_REJECTED:
                $subjectPart = Module::t('amospartnershipprofiles', '#rejected_mail');
                $relevantStr = Module::t('amospartnershipprofiles', 'does not consider');
                break;
        }
        /** @var CrudController $controller */
        $controller = \Yii::$app->controller;
        $contentView = "@vendor/arter/amos-partnership-profiles/src/views/expressions-of-interest/email/evaluation_content";
        $subject = $controller->renderMailPartial($contentView . "_subject", [
            'subjectPart' => $subjectPart,
        ]);
        $text = $controller->renderMailPartial($contentView, [
            'expressionOfInterest' => $expressionOfInterest,
            'relevantStr' => $relevantStr,
        ]);
        $ok = PartnershipProfilesEmailUtility::sendMail(null, $toEmails, $subject, $text, [], $bcc);
        return $ok;
    }
}
