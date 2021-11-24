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

use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\models\AmosWidgets;

/**
 * Class m161207_110646_add_init_community_widgets
 */
class m161207_110646_add_init_community_widgets extends AmosMigrationWidgets
{
    const MODULE_NAME = 'community';

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \arter\amos\community\widgets\icons\WidgetIconCommunityDashboard::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED
            ],
            [
                'classname' => 'arter\amos\community\widgets\icons\WidgetIconTipologiaCommunity',
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\community\widgets\icons\WidgetIconCommunityDashboard::className(),
                'update' => true
            ],
            [
                'classname' => \arter\amos\community\widgets\icons\WidgetIconCommunity::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\community\widgets\icons\WidgetIconCommunityDashboard::className(),
                'update' => true
            ],
            [
                'classname' => \arter\amos\community\widgets\icons\WidgetIconMyCommunities::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\community\widgets\icons\WidgetIconCommunityDashboard::className(),
                'update' => true
            ],
            [
                'classname' => \arter\amos\community\widgets\icons\WidgetIconCreatedByCommunities::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\community\widgets\icons\WidgetIconCommunityDashboard::className(),
                'update' => true
            ],
        ];
    }
}
