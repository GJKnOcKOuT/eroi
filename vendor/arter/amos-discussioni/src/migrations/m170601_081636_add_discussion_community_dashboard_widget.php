<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


use arter\amos\dashboard\models\AmosWidgets;

class m170601_081636_add_discussion_community_dashboard_widget extends \arter\amos\core\migration\AmosMigrationWidgets
{
    const MODULE_NAME = 'discussioni';

    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniDashboard::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED
            ],
            [
                'classname' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioni::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'update' => true,
                'status' => AmosWidgets::STATUS_DISABLED
            ],

        ];
    }
}