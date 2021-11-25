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


use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\models\AmosWidgets;

/**
 * Class m181220_161715_init_bestpractice_widgets
 */
class m181220_161715_init_bestpractice_widgets extends AmosMigrationWidgets
{

    const MODULE_NAME = 'bestpractice';

    /**
     * {@inheritdoc}
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => arter\amos\best\practice\widgets\icons\WidgetIconBestPracticeDashboard::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => null,
                'dashboard_visible' => 1,
                'default_order' => 1
            ],
            [
                'classname' => arter\amos\best\practice\widgets\icons\WidgetIconBestPracticeOwnInterest::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => arter\amos\best\practice\widgets\icons\WidgetIconBestPracticeDashboard::className(),
                'dashboard_visible' => 0,
                'default_order' => 10
            ],
            [
                'classname' => arter\amos\best\practice\widgets\icons\WidgetIconBestPracticeAll::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => arter\amos\best\practice\widgets\icons\WidgetIconBestPracticeDashboard::className(),
                'dashboard_visible' => 0,
                'default_order' => 20
            ],
            [
                'classname' => arter\amos\best\practice\widgets\icons\WidgetIconBestPracticeCreatedBy::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => arter\amos\best\practice\widgets\icons\WidgetIconBestPracticeDashboard::className(),
                'dashboard_visible' => 0,
                'default_order' => 30
            ],
            [
                'classname' => arter\amos\best\practice\widgets\icons\WidgetIconBestPracticeToValidate::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => arter\amos\best\practice\widgets\icons\WidgetIconBestPracticeDashboard::className(),
                'dashboard_visible' => 0,
                'default_order' => 40
            ],
            [
                'classname' => arter\amos\best\practice\widgets\icons\WidgetIconBestPracticeAdminAll::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => arter\amos\best\practice\widgets\icons\WidgetIconBestPracticeDashboard::className(),
                'dashboard_visible' => 0,
                'default_order' => 50
            ],
        ];
    }
}
