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
 * @package    arter\amos\dashboard\utility
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\dashboard\utility;

use arter\amos\dashboard\models\AmosUserDashboards;
use arter\amos\dashboard\models\AmosUserDashboardsWidgetMm;
use yii\base\BaseObject;
use yii\db\Query;
use yii\log\Logger;

/**
 * Class DashboardUtility
 * @package arter\amos\dashboard\utility
 */
class DashboardUtility extends BaseObject
{
    /**
     * This method reset all dashboards by module. You can specify a user ID
     * and it will be used to reset only the dashboard of that user.
     * @param string $module
     * @param int $userId
     * @return bool
     */
    public static function resetDashboardsByModule($module, $userId = 0)
    {
        $allOk = true;
        $query = new Query();
        $query->from(AmosUserDashboards::tableName())->andWhere(['module' => $module]);
        if (is_numeric($userId) && ($userId > 0)) {
            $query->andWhere(['user_id' => $userId]);
        }
        $dashboards = $query->all();
        foreach ($dashboards as $dashboard) {
            try {
                AmosUserDashboardsWidgetMm::deleteAll(['amos_user_dashboards_id' => $dashboard['id']]);
                AmosUserDashboards::deleteAll(['id' => $dashboard['id']]);
            } catch (\Exception $exception) {
                $allOk = false;
            }
        }
        return $allOk;
    }

    /**
     * This method reset all dashboards by user ID. You can specify a module
     * and it will be used to reset only the dashboard of that module.
     * @param int $userId
     * @param string $module
     * @return bool
     */
    public static function resetDashboardsByUser($userId, $module = '')
    {
        $allOk = true;
        $query = new Query();
        $query->from(AmosUserDashboards::tableName())->andWhere(['user_id' => $userId]);
        if (is_string($module) && ($module > 0)) {
            $query->andWhere(['module' => $module]);
        }
        $dashboards = $query->all();
        foreach ($dashboards as $dashboard) {
            try {
                AmosUserDashboardsWidgetMm::deleteAll(['amos_user_dashboards_id' => $dashboard['id']]);
                AmosUserDashboards::deleteAll(['id' => $dashboard['id']]);
            } catch (\Exception $exception) {
                $allOk = false;
            }
        }
        return $allOk;
    }

    /**
     * This method reset all dashboards by user ID. You can specify a module
     * and it will be used to reset only the dashboard of that module.
     * @param int[] $excludedUserIds
     * @param string[] $excludedModules
     * @return bool
     */
    public static function resetAllDashboards($excludedUserIds = [], $excludedModules = [])
    {
        $allOk = true;
        $query = new Query();
        $query->from(AmosUserDashboards::tableName());
        if (is_array($excludedUserIds) && !empty($excludedUserIds)) {
            $query->andWhere(['not in', 'user_id', $excludedUserIds]);
        }
        if (is_array($excludedModules) && !empty($excludedModules)) {
            $query->andWhere(['not in', 'module', $excludedModules]);
        }
        $dashboards = $query->all();
        foreach ($dashboards as $dashboard) {
            try {
                AmosUserDashboardsWidgetMm::deleteAll(['amos_user_dashboards_id' => $dashboard['id']]);
                AmosUserDashboards::deleteAll(['id' => $dashboard['id']]);
            } catch (\Exception $exception) {
                \Yii::getLogger()->log($exception->getMessage(), Logger::LEVEL_ERROR);
                $allOk = false;
            }
        }
        return $allOk;
    }
}
