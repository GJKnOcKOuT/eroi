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

use arter\amos\core\rules\BasicContentRule;
use arter\amos\partnershipprofiles\models\PartnershipProfiles;

/**
 * Class PartnershipProfilesDraftStatusRule
 * @package arter\amos\partnershipprofiles\rules
 */
class PartnershipProfilesDraftStatusRule extends BasicContentRule
{
    public $name = 'partnershipProfilesDraftStatus';

    /**
     * @inheritdoc
     */
    public function ruleLogic($user, $item, $params, $model)
    {
        $canClose = false;

        if ($model instanceof PartnershipProfiles) {
            /** @var PartnershipProfiles $model */
            $allowedUserIds = [
                $model->created_by,
            ];
            $facilitator = $model->partnershipProfileFacilitator;
            if (!is_null($facilitator)) {
                $allowedUserIds[] = $facilitator->user_id;
            }
            $canClose = in_array($user, $allowedUserIds);
        }

        return $canClose;
    }
}
