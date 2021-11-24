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
 * @package    arter\amos\ticket\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\models\AmosWidgets;

/**
 * Class m181023_152000_update_widgets_tickets
 */
class m181023_152000_update_widgets_tickets extends AmosMigrationWidgets
{
    const MODULE_NAME = 'ticket';

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = array_merge(
            $this->initIconWidgetsConf(),
            $this->initGraphicWidgetsConf()
        );
    }

    /**
     * Init the icon widgets configurations
     * @return array
     */
    private function initIconWidgetsConf()
    {
        return [
            [
                'classname' => arter\amos\ticket\widgets\icons\WidgetIconTicketFaq::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\ticket\widgets\icons\WidgetIconTicketDashboard::className(),
                'default_order' => 10,
            ],
            [
                'classname' => arter\amos\ticket\widgets\icons\WidgetIconTicketWaiting::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\ticket\widgets\icons\WidgetIconTicketDashboard::className(),
                'default_order' => 20,
            ],
            [
                'classname' => arter\amos\ticket\widgets\icons\WidgetIconTicketProcessing::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\ticket\widgets\icons\WidgetIconTicketDashboard::className(),
                'default_order' => 30,
            ],
            [
                'classname' => arter\amos\ticket\widgets\icons\WidgetIconTicketClosed::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\ticket\widgets\icons\WidgetIconTicketDashboard::className(),
                'default_order' => 40,
            ],
            [
                'classname' => arter\amos\ticket\widgets\icons\WidgetIconTicketAll::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\ticket\widgets\icons\WidgetIconTicketDashboard::className(),
                'default_order' => 50,
            ],
            [
                'classname' => arter\amos\ticket\widgets\icons\WidgetIconTicketCategorie::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\ticket\widgets\icons\WidgetIconTicketDashboard::className(),
                'default_order' => 100,
            ],
            [
                'classname' => arter\amos\ticket\widgets\icons\WidgetIconTicketAdminFaq::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\ticket\widgets\icons\WidgetIconTicketDashboard::className(),
                'default_order' => 110,
            ],
        ];
    }

    /**
     * Init the graphic widgets configurations
     * @return array
     */
    private function initGraphicWidgetsConf()
    {
        return [
        ];
    }
}
