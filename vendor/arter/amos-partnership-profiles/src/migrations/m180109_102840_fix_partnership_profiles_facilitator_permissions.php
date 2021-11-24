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
use arter\amos\partnershipprofiles\rules\DeleteFacilitatorOwnExprOfIntRule;
use arter\amos\partnershipprofiles\rules\DeleteFacilitatorOwnPartnershipProfilesRule;
use arter\amos\partnershipprofiles\rules\UpdateFacilitatorOwnExprOfIntRule;
use arter\amos\partnershipprofiles\rules\UpdateFacilitatorOwnPartnershipProfilesRule;

/**
 * Class m180109_102840_fix_partnership_profiles_facilitator_permissions
 */
class m180109_102840_fix_partnership_profiles_facilitator_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'PARTNERSHIPPROFILES_UPDATE',
                'update' => true,
                'newValues' => [
                    'addParents' => [UpdateFacilitatorOwnPartnershipProfilesRule::className()]
                ]
            ],
            [
                'name' => 'PARTNERSHIPPROFILES_DELETE',
                'update' => true,
                'newValues' => [
                    'addParents' => [DeleteFacilitatorOwnPartnershipProfilesRule::className()]
                ]
            ],
            [
                'name' => 'EXPRESSIONSOFINTEREST_UPDATE',
                'update' => true,
                'newValues' => [
                    'addParents' => [UpdateFacilitatorOwnExprOfIntRule::className()]
                ]
            ],
            [
                'name' => 'EXPRESSIONSOFINTEREST_DELETE',
                'update' => true,
                'newValues' => [
                    'addParents' => [DeleteFacilitatorOwnExprOfIntRule::className()]
                ]
            ]
        ];
    }
}
