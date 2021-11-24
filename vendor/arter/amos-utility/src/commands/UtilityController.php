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
 * @package    arter-basic-template
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\utility\commands;

use arter\amos\core\utilities\ClassUtility;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;

class UtilityController extends Controller
{

    public
        $moduleName = null;

    /**
     * 
     * @param type $actionID
     * @return type
     */
    public function options($actionID)
    {
        return ['moduleName', 'bulletCounters'];
    }

    /**
     * 
     */
    public function actionBulletCounters()
    {
        $classname = 'arter\amos\utility\controllers\BulletCountersController';
        
        try {
            if (ClassUtility::classExist($classname)) {
                $bulletCounters = new $classname('_cbc', null);
                Console::stdout($bulletCounters->actionIndex());
            } else {
                Console::stdout('Object not found');
            }
        } catch (Exception $ex) {
            
        }
    }

    /**
     *
     */
    public function actionResetDashboardByModule()
    {
        $classname = 'arter\amos\dashboard\utility\DashboardUtility';

        try {
            if (ClassUtility::classExist($classname)) {
                if (!empty($this->moduleName)) {
                    Console::stdout('Reset dashboard for:' . $this->moduleName);
                    $classname::resetDashboardsByModule($this->moduleName);
                } else {
                    Console::stdout('Missing moduleName param.');
                }
            }
        } catch (\yii\base\Exception $ex) {
            
        }
    }

}
