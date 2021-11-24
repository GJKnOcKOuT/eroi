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

use arter\amos\community\models\Community;
use arter\amos\core\rules\DefaultOwnContentRule;

/**
 * Class TicketManagerInCommunityRoleRule
 * @package arter\amos\ticket\rules
 */
class TicketManagerInCommunityRoleRule extends DefaultOwnContentRule
{
    /**
     * @inheritdoc
     */
    public $name = 'ticketManagerInCommunityRole';

    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        $moduleCwh = \Yii::$app->getModule('cwh');
        $moduleCommunity = \Yii::$app->getModule('community');
        if (isset($moduleCwh) && isset($moduleCommunity) && !empty($moduleCwh->getCwhScope())) {
            $scope = $moduleCwh->getCwhScope();
            if (isset($scope['community'])) {
                $community = Community::findOne(['id' => $scope['community']]);
                if (!empty($community)) {
                    return $community->isCommunityManager($user);
                }
            }
        }
        return false;
    }
}
