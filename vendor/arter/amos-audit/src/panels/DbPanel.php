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


namespace arter\amos\audit\panels;

use arter\amos\audit\components\panels\DataStoragePanelTrait;

use Yii;
use yii\debug\models\search\Db;
use yii\grid\GridViewAsset;

/**
 * DbPanel
 * @package arter\amos\audit\panels
 *
 * @method bool hasExplain()
 * @method int sumDuplicateQueries()
 */
class DbPanel extends \yii\debug\panels\DbPanel
{
    use DataStoragePanelTrait;

    /**
     * @var array current database request timings
     */
    private $_timings;

    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        $timings = $this->calculateTimings();
        $queryCount = count($timings);
        $queryTime = number_format($this->getTotalQueryTime($timings) * 1000) . ' ms';
        return $this->getName() . ' <small>(' . $queryCount . ' / ' . $queryTime . ')</small>';
    }

    /**
     * @inheritdoc
     */
    public function getDetail()
    {
        $searchModel = new Db();

        if (!$searchModel->load(Yii::$app->request->getQueryParams())) {
            $searchModel->load($this->defaultFilter, '');
        }

        $models = $this->getModels();
        $dataProvider = $searchModel->search($models);
        $dataProvider->getSort()->defaultOrder = $this->defaultOrder;

        return Yii::$app->view->render('@yii/debug/views/default/panels/db/detail', [
            'panel' => $this,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'hasExplain' => method_exists($this, 'hasExplain') ? $this->hasExplain() : null,
            'sumDuplicates' => method_exists($this, 'sumDuplicateQueries') ? $this->sumDuplicateQueries($models) : null,
        ]);
    }

    public function save()
    {
        $data = parent::save();
        return (isset($data['messages']) && count($data['messages']) > 0) ? $data : null;
    }

    /**
     * @inheritdoc
     */
    public function registerAssets($view)
    {
        GridViewAsset::register($view);
    }

    /**
     * Calculates given request profile timings.
     *
     * @return array timings [token, category, timestamp, traces, nesting level, elapsed time]
     */
    public function calculateTimings()
    {
        if ($this->_timings === null) {
            $this->_timings = [];
            if (isset($this->data['messages'])) {
                $this->_timings = Yii::getLogger()->calculateTimings($this->data['messages']);
            }
        }
        return $this->_timings;
    }
}