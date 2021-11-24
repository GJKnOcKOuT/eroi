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
 * @package    arter\amos\notify\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\models\AmosWidgets;
use arter\amos\notificationmanager\widgets\icons\WidgetIconNewsletterAll;
use arter\amos\notificationmanager\widgets\icons\WidgetIconNewsletterCreatedBy;
use arter\amos\notificationmanager\widgets\icons\WidgetIconNewsletterDashboard;

/**
 * Class m200429_071951_newsletter_widget
 */
class m200429_071951_newsletter_widget extends AmosMigrationWidgets
{
    const MODULE_NAME = 'notify';
    
    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => WidgetIconNewsletterDashboard::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'default_order' => 120,
                'dashboard_visible' => 1
            ],
            [
                'classname' => WidgetIconNewsletterAll::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => WidgetIconNewsletterDashboard::className(),
                'default_order' => 10,
                'dashboard_visible' => 0
            ],
            [
                'classname' => WidgetIconNewsletterCreatedBy::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => WidgetIconNewsletterDashboard::className(),
                'default_order' => 20,
                'dashboard_visible' => 0
            ]
        ];
    }
}
