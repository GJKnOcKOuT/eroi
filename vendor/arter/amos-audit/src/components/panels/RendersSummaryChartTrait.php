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

/**
 * Created by shalvah
 */

namespace arter\amos\audit\components\panels;

/**
 * Trait RendersSummaryChartTrait
 * @package arter\amos\audit\components\panels
 *
 * Used by audit panels or controllers which want to render a summary chart in their view
 */
trait RendersSummaryChartTrait
{
    /**
     * The name of the model for which the chart should be rendered
     *
     * @return string Fully namespaced class name
     */
    protected function getChartModel()
    {
        return static::className();
    }

    /**
     * Return audit data for the last seven days
     * to be rendered on the chart
     *
     * @return array
     */
    protected function getChartData()
    {
        //initialise defaults (0 entries) for each day
        $defaults = [];
        $startDate = strtotime('-6 days');
        foreach (range(-6, 0) as $day) {
            $defaults[date('D: Y-m-d', strtotime($day . 'days'))] = 0;
        }

        $panelModel = $this->getChartModel();
        $results = $panelModel::find()
            ->select(["COUNT(DISTINCT id) as count", "created AS day"])
            ->where(['between', 'created',
                date('Y-m-d 00:00:00', $startDate),
                date('Y-m-d 23:59:59')])
            ->groupBy("day")->indexBy('day')->column();

        // replace defaults with data from db where available
        foreach ($results as $date => $count) {
            $date = date('D: Y-m-d', strtotime($date));
            $defaults[$date] += $count;
        }
        return $defaults;
    }
}
