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
 * @package    arter\amos\dashboard
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\dashboard\commands;

use arter\amos\core\module\Module;
use arter\amos\core\module\ModuleInterface;
use arter\amos\dashboard\models\AmosWidgets;
use Yii;

class DashboardController extends \yii\console\Controller
{
    public function actionRefreshWidgets()
    {
        AmosWidgets::deleteAll();

        foreach (Yii::$app->getModules() as $id => $module) {
            $moduleObj = Yii::$app->getModule($id);
            $class = new \ReflectionClass($moduleObj);

            if ($id == 'news') {
                continue;
            }

            if ($class->implementsInterface(ModuleInterface::class)) {
                /**@var $moduleObj Module */
                if (($WidgetIcons = $moduleObj->getWidgetIcons())) {
                    foreach ($WidgetIcons as $WidgetIcon) {
                        $AmosWidget = new AmosWidgets(
                            [
                                'classname' => get_class(Yii::createObject($WidgetIcon)),
                                'type' => AmosWidgets::TYPE_ICON,
                                'status' => AmosWidgets::STATUS_ENABLED,
                                'module' => $moduleObj->getModuleName()
                            ]
                        );
                        $AmosWidget->save();
                    }
                }
                if (($WidgetGraphics = $moduleObj->getWidgetGraphics())) {
                    foreach ($WidgetGraphics as $WidgetGraphic) {
                        $AmosWidget = new AmosWidgets(
                            [
                                'classname' => get_class($WidgetGraphic),
                                'type' => AmosWidgets::TYPE_GRAPHIC,
                                'status' => AmosWidgets::STATUS_ENABLED,
                                'module' => $moduleObj->getModuleName()
                            ]
                        );
                        $AmosWidget->save();
                    }
                }
            }
        }
    }

}