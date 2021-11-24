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

use backend\modules\aster_partnership_profiles\rules\ArterPartnershipProfilesCloseStatusRule;
use arter\amos\core\migration\AmosMigrationPermissions;
use arter\amos\partnershipprofiles\models\PartnershipProfiles;
use arter\amos\partnershipprofiles\rules\PartnershipProfilesCloseStatusRule;
use yii\rbac\Permission;

/**
 * Class m201221_151421_change_arter_partnership_profiles_workflow_permissions
 */
class m201221_151421_change_arter_partnership_profiles_workflow_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => ArterPartnershipProfilesCloseStatusRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to close a partnership profile for ArtEr',
                'ruleName' => ArterPartnershipProfilesCloseStatusRule::className(),
                'parent' => ['PARTNERSHIP_PROFILES_CREATOR', 'PARTNERSHIP_PROFILES_FACILITATOR'],
                'children' => [PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_CLOSED]
            ],
            [
                'name' => PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_CLOSED,
                'update' => true,
                'newValues' => [
                    'removeParents' => [
                        PartnershipProfilesCloseStatusRule::className()
                    ]
                ]
            ],
            [
                'name' => PartnershipProfilesCloseStatusRule::className(),
                'update' => true,
                'newValues' => [
                    'removeParents' => [
                        'PARTNERSHIP_PROFILES_CREATOR',
                        'PARTNERSHIP_PROFILES_FACILITATOR'
                    ]
                ]
            ]
        ];
    }
}
