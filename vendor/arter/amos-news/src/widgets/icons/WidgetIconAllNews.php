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
 * @package    arter\amos\news
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\news\widgets\icons;

use arter\amos\core\widget\WidgetIcon;
use arter\amos\core\widget\WidgetAbstract;
use arter\amos\core\icons\AmosIcons;

use arter\amos\news\AmosNews;
//use arter\amos\news\models\search\NewsSearch;
//use arter\amos\news\models\News;

use arter\amos\utility\models\BulletCounters;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconAllNews
 * @package arter\amos\news\widgets\icons
 */
class WidgetIconAllNews extends WidgetIcon
{

    /**
     * @inheritdoc
     */
    public function init()
    {

        parent::init();

        $paramsClassSpan = [
            'bk-backgroundIcon',
            'color-primary'
        ];

        $this->setLabel(AmosNews::tHtml('amosnews', 'Tutte le notizie'));
        $this->setDescription(AmosNews::t('amosnews', 'Visualizza tutte le notizie'));

        if (!empty(Yii::$app->params['dashboardEngine']) && Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
            $this->setIconFramework(AmosIcons::IC);
            $this->setIcon('news');
            $paramsClassSpan = [];
        } else {
            $this->setIcon('feed');
        }

        $this->setUrl(['/news/news/all-news']);

        $this->setCode('ALL-NEWS');
        $this->setModuleName('news');
        $this->setNamespace(__CLASS__);

        $this->setClassSpan(
            ArrayHelper::merge(
                $this->getClassSpan(),
                $paramsClassSpan
            )
        );

        
        // Read and reset counter from bullet_counters table, bacthed calculated!
        if ($this->disableBulletCounters == false) { 
            $this->setBulletCount(
                BulletCounters::getAmosWidgetIconCounter(
                    Yii::$app->getUser()->getId(), 
                    AmosNews::getModuleName(),
                    $this->getNamespace(),
                    $this->resetBulletCount(),
                    null,
                    WidgetIconNews::className(),
                    $this->saveMicrotime
            ));
        }
        
//        // TDB era attivo il conteggio!
//        
//        
//        if ($this->disableBulletCounters == false) {
//            $search = new NewsSearch();
//            $search->setEventAfterCounter();
//
//            $query = $search->buildQuery([], 'all');
//
//            $this->setBulletCount(
//                $this->makeBulletCounter(
//                    Yii::$app->getUser()->getId(),
//                    News::className(),
//                    $query
//                )
//            );
//
//            \Yii::$app->session->set('_offQuery', $query);
//            $this->trigger(self::EVENT_AFTER_COUNT);
//        }
    }
    
    

    /**
     * Aggiunge all'oggetto container tutti i widgets recuperati dal controller del modulo
     * 
     * @inheritdoc
     */
    public function getOptions()
    {
        return ArrayHelper::merge(
                parent::getOptions(),
                ['children' => []]
        );
    }

}
