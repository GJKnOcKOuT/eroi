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
 * @package    arter\amos\admin\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\rules\ShowCommunityManagerWidgetRule;
use arter\amos\core\migration\AmosMigrationPermissions;

/**
 * Class m170710_082659_show_admin_community_manager_widget_rule
 */
class m170710_082659_show_admin_community_manager_widget_rule extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => \arter\amos\admin\widgets\icons\WidgetIconCommunityManagerUserProfiles::className(),
                'update' => true,
                'newValues' => [
                    'ruleName' => ShowCommunityManagerWidgetRule::className()
                ],
                'oldValues' => [
                    'ruleName' => null
                ]
            ]
        ];
    }
}
