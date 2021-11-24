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
 * @package    arter\amos\ticket\rules
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\ticket\rules;

use arter\amos\core\rules\BasicContentRule;

/**
 * Class TicketDeleteRule
 * @package arter\amos\ticket\rules
 */
class TicketDeleteRule extends BasicContentRule
{
    public $name = 'TicketDeleteRule';

    /**
     * @inheritdoc
     */
    public function ruleLogic($user, $item, $params, $model)
    {
        //$referenteFlag = $model->isReferente($user);
        return false;
    }
}
