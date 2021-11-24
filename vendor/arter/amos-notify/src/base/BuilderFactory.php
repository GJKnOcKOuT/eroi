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
 * @package    arter\amos\notificationmanager\base
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\notificationmanager\base;

use arter\amos\notificationmanager\base\builder\ContactAcceptedMailBuilder;
use arter\amos\notificationmanager\base\builder\ContentImmediateMailBuilder;
use arter\amos\notificationmanager\base\builder\ContentMailBuilder;
use arter\amos\notificationmanager\base\builder\CustomMailBuilder;
use arter\amos\notificationmanager\base\builder\NewsletterBuilder;
use arter\amos\notificationmanager\base\builder\SleepingUserMailBuilder;
use arter\amos\notificationmanager\base\builder\SuccessfulContentMailBuilder;
use arter\amos\notificationmanager\base\builder\SuccessfulUserMailBuilder;
use arter\amos\notificationmanager\base\builder\SuggestedLinkMailBuilder;
use arter\amos\notificationmanager\base\builder\ValidatedMailBuilder;
use arter\amos\notificationmanager\base\builder\ValidatorsMailBuilder;
use arter\amos\notificationmanager\models\ChangeStatusEmail;
use yii\base\BaseObject;

/**
 * Class BuilderFactory
 * @package arter\amos\notificationmanager\base
 */
class BuilderFactory extends BaseObject
{
    const CONTENT_MAIL_BUILDER = 1;
    const VALIDATORS_MAIL_BUILDER = 2;
    const VALIDATED_MAIL_BUILDER = 3;
    const CUSTOM_MAIL_BUILDER = 4;
    const CONTENT_IMMEDIATE_MAIL_BUILDER = 5;
    const CONTENT_SLEEPING_USER_BUILDER = 6;
    const CONTENT_SUCCESSFUL_CONTENT_BUILDER = 7;
    const CONTENT_SUCCESSFUL_USER_BUILDER = 8;
    const CONTENT_SUGGESTED_LINK_BUILDER = 9;
    const CONTENT_CONTACT_ACCEPTED_BUILDER = 10;
    const NEWSLETTER_BUILDER = 11;
    
    /**
     * @param int $type
     * @param ChangeStatusEmail|null $email
     * @param string|null $endStatus
     * @return ContentMailBuilder|CustomMailBuilder|ValidatedMailBuilder|ValidatorsMailBuilder|null
     */
    public function create($type, $email = null, $endStatus = null)
    {
        $obj = null;
        
        switch ($type) {
            case self::CONTENT_MAIL_BUILDER:
                $obj = new ContentMailBuilder();
                break;
            case self::CONTENT_IMMEDIATE_MAIL_BUILDER:
                $obj = new ContentImmediateMailBuilder();
                break;
            case self::VALIDATORS_MAIL_BUILDER:
                $obj = new ValidatorsMailBuilder();
                break;
            case self::VALIDATED_MAIL_BUILDER:
                $obj = new ValidatedMailBuilder();
                break;
            case self::CUSTOM_MAIL_BUILDER:
                $obj = new CustomMailBuilder(['emailConf' => $email, 'endStatus' => $endStatus]);
                break;
            case self::CONTENT_SLEEPING_USER_BUILDER:
                $obj = new SleepingUserMailBuilder();
                break;
            case self::CONTENT_SUCCESSFUL_CONTENT_BUILDER:
                $obj = new SuccessfulContentMailBuilder();
                break;
            case self::CONTENT_SUCCESSFUL_USER_BUILDER:
                $obj = new SuccessfulUserMailBuilder();
                break;
            case self::CONTENT_SUGGESTED_LINK_BUILDER:
                $obj = new SuggestedLinkMailBuilder();
                break;
            case self::CONTENT_CONTACT_ACCEPTED_BUILDER:
                $obj = new ContactAcceptedMailBuilder();
                break;
            case self::NEWSLETTER_BUILDER:
                $obj = new NewsletterBuilder();
                break;
        }
        
        return $obj;
    }
}
