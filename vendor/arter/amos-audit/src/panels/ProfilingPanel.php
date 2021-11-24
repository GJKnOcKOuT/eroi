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
use yii\debug\models\search\Profile;
use yii\grid\GridViewAsset;

/**
 * ProfilingPanel
 * @package arter\amos\audit\panels
 */
class ProfilingPanel extends \yii\debug\panels\ProfilingPanel
{
    use DataStoragePanelTrait;

    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        $memory = isset($this->data['memory']) ? sprintf('%.1f MB', $this->data['memory'] / 1048576) : '';
        $time = isset($this->data['time']) ? number_format($this->data['time'] * 1000) . ' ms' : '';
        return $this->getName() . ' <small>(' . $memory . ' / ' . $time . ')</small>';
    }

    /**
     * @inheritdoc
     */
    public function getDetail()
    {
        $searchModel = new Profile();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams(), $this->getModels());

        return Yii::$app->view->render('@yii/debug/views/default/panels/profile/detail', [
            'panel' => $this,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'memory' => isset($this->data['memory']) ? sprintf('%.1f MB', $this->data['memory'] / 1048576) : '',
            'time' => isset($this->data['time']) ? number_format($this->data['time'] * 1000) . ' ms' : '',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function registerAssets($view)
    {
        GridViewAsset::register($view);
    }

}
