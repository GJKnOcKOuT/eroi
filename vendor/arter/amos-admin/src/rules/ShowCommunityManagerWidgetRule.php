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
 * @package    arter\amos\admin\rules
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\admin\rules;

use yii\rbac\Rule;

/**
 * Class ShowCommunityManagerWidgetRule
 * @package arter\amos\admin\rules
 */
class ShowCommunityManagerWidgetRule extends Rule
{
    public $name = 'showCommunityManagerWidget';
    
    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        $communityModule = \Yii::$app->getModule('community');
        return (!is_null($communityModule));
    }
}
