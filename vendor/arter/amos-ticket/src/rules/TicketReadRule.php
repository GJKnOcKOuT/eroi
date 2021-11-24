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
 * Class TicketReadRule
 * @package arter\amos\ticket\rules
 */
class TicketReadRule extends BasicContentRule
{
    public $name = 'TicketReadRule';

    /**
     * @inheritdoc
     */
    public function ruleLogic($user, $item, $params, $model)
    {
        return ($model->created_by == $user) || $model->isReferente($user) || $model->isAncestorVisible();
    }
}
