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
 * @package    arter\amos\events\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\models\AmosWidgets;

/**
 * Class m180410_095645_add_events_community_widgets
 */
class m180522_110000_add_community_widgets extends AmosMigrationWidgets
{
    const EVENTS_MODULE_NAME = 'community';

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => 'arter\amos\documenti\widgets\graphics\WidgetGraphicsUltimiDocumenti',
                'type' => AmosWidgets::TYPE_GRAPHIC,
                'module' => self::EVENTS_MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'default_order' => 40,
                'dashboard_visible' => 0,
                'sub_dashboard' => 1
            ],
            [
                'classname' => 'arter\amos\community\widgets\graphics\WidgetGraphicsMyCommunities',
                'type' => AmosWidgets::TYPE_GRAPHIC,
                'module' => self::EVENTS_MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'default_order' => 30,
                'dashboard_visible' => 0,
                'sub_dashboard' => 1
            ],
            [
                'classname' => 'arter\amos\discussioni\widgets\graphics\WidgetGraphicsUltimeDiscussioni',
                'type' => AmosWidgets::TYPE_GRAPHIC,
                'module' => self::EVENTS_MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'default_order' => 20,
                'dashboard_visible' => 0,
                'sub_dashboard' => 1
            ],
            [
                'classname' => 'arter\amos\news\widgets\graphics\WidgetGraphicsUltimeNews',
                'type' => AmosWidgets::TYPE_GRAPHIC,
                'module' => self::EVENTS_MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'default_order' => 10,
                'dashboard_visible' => 0,
                'sub_dashboard' => 1
            ],
        ];
    }
}
