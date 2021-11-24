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
 * @package    arter\amos\core\views\toolbars
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\views\toolbars;

use arter\amos\core\icons\AmosIcons;
use Yii;

class StatsToolbarPanels
{
    /**
     * @param $model
     * @param $count
     * @return array
     */
    public static function getCommentsPanel($model, $count, $disableLink = false)
    {
        return array('comments' => new CommentStatsPanel([
            'icon' => AmosIcons::show('comments'),
            'label' => '',
            'description' => \Yii::t('amoscore', '#StatsBar_Interventions'),
            'count' => $count,
            'disableLink' => $disableLink,
            'url' => Yii::$app->getUrlManager()->createUrl([
                $model->getViewUrl(),
                'id' => $model->getPrimaryKey(),
                '#' => 'comments_anchor',
            ])
        ]));
    }

    /**
     * @param $model
     * @param $count
     * @return array
     */
    public static function getTagsPanel($model, $count, $disableLink = false)
    {
        return array('tags' => new StatsPanel([
            'icon' => AmosIcons::show('label'),
            'label' => '',
            'count' => $count,
            'disableLink' => $disableLink,
            'description' => Yii::t('amoscore', '#StatsBar_Tags'),
            'url' => Yii::$app->getUrlManager()->createUrl([
                $model->getViewUrl(),
                'id' => $model->getPrimaryKey(),
                '#' => 'tab-classifications'
            ])
        ]));
    }

    /**
     * @param $model
     * @param $count
     * @return array
     */
    public static function getDocumentsPanel($model, $count, $disableLink = false)
    {
        return array('documents' => new StatsPanel([
            'icon' => AmosIcons::show('paperclip', [], 'dash'),
            'label' => '',
            'count' => $count, //calculate only attach and not principal files.
            'disableLink' => $disableLink,
            'description' => Yii::t('amoscore', '#StatsBar_Attachments'),
            'url' => \Yii::$app->getUrlManager()->createUrl([
                $model->getViewUrl(),
                'id' => $model->getPrimaryKey(),
                '#' => 'tab-attachments'
            ])
        ]));
    }

    /**
     * @param $model
     * @param $count
     * @return array
     */
    public static function getReportsPanel($model, $count, $disableLink = false)
    {
        return array('reports' => new StatsPanel([
            'icon' => AmosIcons::show('flag', [], 'dash'),
            'label' => '',
            'count' => $count,
            'disableLink' => $disableLink,
            'description' => Yii::t('amoscore', '#StatsBar_Reports'),
            'url' => $model->getViewUrl(),
        ]));
    }
}
