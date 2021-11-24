<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\platform\common\console\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;


/**
* Class m200113_154819_users_animation_mm_permissions*/
class m200115_094819_cm_sfide_roles extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = '';

        return [
                [
                    'name' =>  'CM_SFIDE',
                    'type' => Permission::TYPE_ROLE,
                    'description' => 'Community manager sfide',
                    'ruleName' => null,
                    'parent' => ['PARTNERSHIP_PROFILES_PLUGIN_ADMINISTRATOR'],
                    'children' => [
                        'PARTNERSHIPPROFILES_UPDATE',
                        'PARTNERSHIPPROFILES_READ',
                        \backend\modules\aster_partnership_profiles\models\PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_VALIDATED,
                        \backend\modules\aster_partnership_profiles\models\PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_TOVALIDATE,
                        \backend\modules\aster_partnership_profiles\models\PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_DRAFT,
                        \backend\modules\aster_partnership_profiles\models\PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_ARCHIVED,
                        \backend\modules\aster_partnership_profiles\models\PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_FEEDBACKRECEIVED,
                        'PartnershipProfilesValidate',
                        'PartnershipProfilesValidateOnDomain'
                    ]
                ],

            ];
    }
}
