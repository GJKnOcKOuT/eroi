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
 * @package    arter\amos\community\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\dashboard\models\AmosWidgets;
use arter\amos\core\migration\AmosMigrationWidgets;

/**
 * Class m190626_123319_init_widget_icons_my_communities_with_tags
 */
class m190626_123319_init_widget_icons_my_communities_with_tags extends AmosMigrationWidgets
{
    const MODULE_NAME = 'community';

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \arter\amos\community\widgets\icons\WidgetIconMyCommunitiesWithTags::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'dashboard_visible' => 0,
                'child_of' => \arter\amos\community\widgets\icons\WidgetIconCommunityDashboard::className(),
                'default_order' => 15
            ],
        ];
    }
}
