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

/**
 * Class DeleteFacilitatorOwnPartnershipProfilesRule
 * @package arter\amos\partnershipprofiles\rules
 */
class DeleteFacilitatorOwnPartnershipProfilesRule extends FacilitatorOwnPartnershipProfilesRule
{
    public $name = 'deleteFacilitatorOwnPartnershipProfiles';

    /**
     * @inheritdoc
     */
    public function facilitatorLogic($user, $item, $params, $model)
    {
        return (!count($model->expressionsOfInterest)); // Return true if the partnership profile doesn't have expressions of interest.
    }
}
