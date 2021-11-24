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
 * @package    arter\amos\utility\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\models\AmosWidgets;
use arter\amos\dashboard\widgets\icons\WidgetIconManagement;
use arter\amos\utility\widgets\icons\WidgetIconUtility;

/**
 * Class m191127_102711_init_utility_widget
 */
class m191127_102711_init_utility_widget extends AmosMigrationWidgets
{
    const MODULE_NAME = 'utility';

    /**
     * {@inheritdoc}
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => WidgetIconUtility::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => WidgetIconManagement::className(),
                'dashboard_visible' => 1,
                'default_order' => 100
            ]
        ];
    }
}
