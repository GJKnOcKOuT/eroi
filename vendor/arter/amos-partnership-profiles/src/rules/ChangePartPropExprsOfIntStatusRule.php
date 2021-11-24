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
use arter\amos\partnershipprofiles\models\ExpressionsOfInterest;

/**
 * Class ChangePartPropExprsOfIntStatusRule
 * @package arter\amos\partnershipprofiles\rules
 */
class ChangePartPropExprsOfIntStatusRule extends BasicContentRule
{
    public $name = 'changePartPropExprsOfIntStatus';

    /**
     * @inheritdoc
     */
    public function ruleLogic($user, $item, $params, $model)
    {
        /** @var ExpressionsOfInterest $model */
        return ($model->partnershipProfile->created_by == $user);
    }
}
