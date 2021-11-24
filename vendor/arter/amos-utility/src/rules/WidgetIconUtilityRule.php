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
 * @package    arter\amos\utility\rules
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\utility\rules;

use yii\rbac\Rule;

/**
 * Class WidgetIconUtilityRule
 * @package arter\amos\utility\rules
 */
class WidgetIconUtilityRule extends Rule
{
    public $name = 'widgetIconUtility';

    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        return true;
    }
}
