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
 * @package    arter\amos\news\widgets\graphics
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\news\widgets\graphics;

use arter\amos\core\widget\WidgetAbstract;
use arter\amos\core\widget\WidgetGraphic;
use arter\amos\news\AmosNews;
use arter\amos\news\models\search\NewsSearch;
use arter\amos\notificationmanager\base\NotifyWidgetDoNothing;

class WidgetGraphicsUltimeNews extends WidgetGraphic {

  /**
   * @inheritdoc
   */
  public function init() {
    parent::init();

    $this->setCode('ULTIME_NEWS_GRAPHIC');
    $this->setLabel(AmosNews::tHtml('amosnews', 'Ultime news'));
    $this->setDescription(AmosNews::t('amosnews', 'Elenca le ultime news'));
  }

  /**
   * 
   * @return type@inheritdoc
   */
  public function getHtml() {
    $search = new NewsSearch();    
    $search->setNotifier(new NotifyWidgetDoNothing());

    $viewPath = '@vendor/arter/amos-news/src/widgets/graphics/views/';   
    $viewToRender = $viewPath . 'ultime_news';

    $newsLimit = AmosNews::MAX_LAST_NEWS_ON_DASHBOARD;
    if (!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
      $newsLimit = 12;
    }
    
    $listaNews = $search->ultimeNews($_GET, $newsLimit);
 
    $moduleLayout = \Yii::$app->getModule('layout');
    if (is_null($moduleLayout)) {
      $viewToRender .= '_old';
    }
    
    return $this->render(
      $viewToRender,
      [
        'listaNews' => $listaNews,
        'widget' => $this,
        'toRefreshSectionId' => 'widgetGraphicLatestNews'
      ]
    );
  }

}