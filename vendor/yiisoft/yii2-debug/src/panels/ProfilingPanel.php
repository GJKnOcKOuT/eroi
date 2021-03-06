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
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\debug\panels;

use Yii;
use yii\debug\models\search\Profile;
use yii\debug\Panel;
use yii\log\Logger;

/**
 * Debugger panel that collects and displays performance profiling info.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ProfilingPanel extends Panel
{
    /**
     * @var array current request profile timings
     */
    private $_models;


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Profiling';
    }

    /**
     * {@inheritdoc}
     */
    public function getSummary()
    {
        return Yii::$app->view->render('panels/profile/summary', [
            'memory' => sprintf('%.3f MB', $this->data['memory'] / 1048576),
            'time' => number_format($this->data['time'] * 1000) . ' ms',
            'panel' => $this
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getDetail()
    {
        $searchModel = new Profile();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $this->getModels());

        return Yii::$app->view->render('panels/profile/detail', [
            'panel' => $this,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'memory' => sprintf('%.3f MB', $this->data['memory'] / 1048576),
            'time' => number_format($this->data['time'] * 1000) . ' ms',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function save()
    {
        $messages = $this->getLogMessages(Logger::LEVEL_PROFILE);
        return [
            'memory' => memory_get_peak_usage(),
            'time' => microtime(true) - YII_BEGIN_TIME,
            'messages' => $messages,
        ];
    }

    /**
     * Returns array of profiling models that can be used in a data provider.
     * @return array models
     */
    protected function getModels()
    {
        if ($this->_models === null) {
            $this->_models = [];
            $timings = Yii::getLogger()->calculateTimings(isset($this->data['messages']) ? $this->data['messages'] : []);

            foreach ($timings as $seq => $profileTiming) {
                $this->_models[] = [
                    'duration' => $profileTiming['duration'] * 1000, // in milliseconds
                    'category' => $profileTiming['category'],
                    'info' => $profileTiming['info'],
                    'level' => $profileTiming['level'],
                    'timestamp' => $profileTiming['timestamp'] * 1000, //in milliseconds
                    'seq' => $seq,
                ];
            }
        }

        return $this->_models;
    }
}
