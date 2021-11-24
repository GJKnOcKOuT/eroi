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
 * Class m170315_135851_init_events_widgets
 */
class m170315_135851_init_events_widgets extends AmosMigrationWidgets
{
    const MODULE_NAME = 'events';

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \arter\amos\events\widgets\icons\WidgetIconEvents::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\events\widgets\icons\WidgetIconEvents::className(),
                'default_order' => 10
            ],
            [
                'classname' => \arter\amos\events\widgets\icons\WidgetIconEventsCreatedBy::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\events\widgets\icons\WidgetIconEvents::className(),
                'default_order' => 20
            ],
            [
                'classname' => \arter\amos\events\widgets\icons\WidgetIconEventTypes::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\events\widgets\icons\WidgetIconEvents::className(),
                'default_order' => 30
            ],
            [
                'classname' => \arter\amos\events\widgets\icons\WidgetIconEventsToPublish::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\events\widgets\icons\WidgetIconEvents::className(),
                'default_order' => 40
            ],
            [
                'classname' => \arter\amos\events\widgets\icons\WidgetIconEventsManagement::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\events\widgets\icons\WidgetIconEvents::className(),
                'default_order' => 50
            ]
        ];
    }
}
