<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_partnership_profiles
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\aster_partnership_profiles;

use arter\amos\core\interfaces\InvitationExternalInterface;

/**
 * Class Module
 * @package backend\modules\aster_partnership_profiles
 */
class Module extends \arter\amos\partnershipprofiles\Module implements InvitationExternalInterface
{
    public $subjectCategory = 'category';
    public $subjectPlaceholder = 'Invito alla sfida';

    /**
     * @inheritdoc
     */
    public function addUserContextAssociation($userId, $modelId)
    {
        $moduleCommunity = \Yii::$app->getModule('community');
        $ok = false;
        if ($moduleCommunity) {


        }
        return $ok;
    }

    /**
     * @inheritdoc
     */
    public function renderInvitationEmailSubject($invitation)
    {
        return '';
//        return \Yii::$app->controller->renderPartial('@vendor/amos/challenge/src/views/emails/_invitation_email_subject', ['invitation' => $invitation]);

    }

    /**
     * @inheritdoc
     */
    public function renderInvitationEmailText($invitation)
    {
        return '';
//        return \Yii::$app->controller->renderPartial('@vendor/amos/challenge/src/views/emails/_invitation_email', ['invitation' => $invitation]);
    }
    
    /**
     * @inheritdoc
     */
    public static function getModelSearchClassName()
    {
        return __NAMESPACE__ . '\models\search\PartnershipProfilesSearch';
    }
}
