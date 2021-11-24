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

use arter\amos\audit\components\panels\Panel;
use arter\amos\audit\components\panels\RendersSummaryChartTrait;
use arter\amos\audit\models\AuditJavascript;
use arter\amos\audit\models\AuditJavascriptSearch;

use Yii;
use yii\grid\GridViewAsset;

/**
 * JavascriptPanel
 * @package arter\amos\audit\panels
 */
class JavascriptPanel extends Panel
{
    use RendersSummaryChartTrait;

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return \Yii::t('audit', 'Javascripts');
    }

    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->getName() . ' <small>(' . count($this->_model->javascripts) . ')</small>';
    }

    /**
     * @inheritdoc
     */
    public function hasEntryData($entry)
    {
        return count($entry->javascripts) > 0;
    }

    /**
     * @inheritdoc
     */
    public function getDetail()
    {
        $searchModel = new AuditJavascriptSearch();
        $params = \Yii::$app->request->getQueryParams();
        $params['AuditJavascriptSearch']['entry_id'] = $params['id'];
        $dataProvider = $searchModel->search($params);

        return \Yii::$app->view->render('panels/javascript/detail', [
            'panel'        => $this,
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getIndexUrl()
    {
        return ['javascript/index'];
    }

    /**
     * @inheritdoc
     */
    protected function getChartModel()
    {
        return AuditJavascript::className();
    }

    /**
     * @inheritdoc
     */
    public function getChart()
    {
        return \Yii::$app->view->render('panels/mail/chart', [
            'panel' => $this,
            'chartData' => $this->getChartData()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function registerAssets($view)
    {
        GridViewAsset::register($view);
    }

    /**
     * @inheritdoc
     */
    public function cleanup($maxAge = null)
    {
        $maxAge = $maxAge !== null ? $maxAge : $this->maxAge;
        if ($maxAge === null)
            return false;
        return AuditJavascript::deleteAll([
            '<=', 'created', date('Y-m-d 23:59:59', strtotime("-$maxAge days"))
        ]);
    }

}