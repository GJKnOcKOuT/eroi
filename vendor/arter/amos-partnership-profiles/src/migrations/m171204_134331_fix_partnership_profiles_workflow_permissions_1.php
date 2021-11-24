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
 * @package    arter\amos\partnershipprofiles\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use arter\amos\partnershipprofiles\models\PartnershipProfiles;

/**
 * Class m171204_134331_fix_partnership_profiles_workflow_permissions_1
 */
class m171204_134331_fix_partnership_profiles_workflow_permissions_1 extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_FEEDBACKRECEIVED,
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'PARTNERSHIP_PROFILES_READER',
                        'PARTNERSHIP_PROFILES_CREATOR',
                        'PARTNERSHIP_PROFILES_VALIDATOR',
                        'PARTNERSHIP_PROFILES_FACILITATOR',
                        'EXPRESSIONS_OF_INTEREST_READER',
                        'EXPRESSIONS_OF_INTEREST_CREATOR',
                        'PARTNER_PROF_EXPR_OF_INT_ADMIN_FACILITATOR'
                    ]
                ]
            ],
            [
                'name' => PartnershipProfiles::PARTNERSHIP_PROFILES_WORKFLOW_STATUS_ARCHIVED,
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        'PARTNERSHIP_PROFILES_READER',
                        'PARTNERSHIP_PROFILES_CREATOR',
                        'PARTNERSHIP_PROFILES_VALIDATOR',
                        'PARTNERSHIP_PROFILES_FACILITATOR',
                        'EXPRESSIONS_OF_INTEREST_READER',
                        'EXPRESSIONS_OF_INTEREST_CREATOR',
                        'PARTNER_PROF_EXPR_OF_INT_ADMIN_FACILITATOR'
                    ]
                ]
            ]
        ];
    }
}
