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
 * @package    arter\amos\utility\drivers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\utility\drivers;

use arter\amos\utility\drivers\base\bcDriver;
use arter\amos\news\models\News;
use arter\amos\news\models\search\NewsSearch;
use arter\amos\news\widgets\icons\WidgetIconAdminAllNews;
use arter\amos\news\widgets\icons\WidgetIconNews;
use arter\amos\news\widgets\icons\WidgetIconAllNews;
use arter\amos\news\widgets\icons\WidgetIconNewsCreatedBy;
use arter\amos\news\widgets\icons\WidgetIconNewsDaValidare;

/**
 * 
 */
class bcDriverNews extends bcDriver
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->modelClassName  = News::className();
        $this->widgetIconNames = [
//            WidgetIconAdminAllNews::getIconName() => WidgetIconAdminAllNews::classname(),
            WidgetIconNews::getWidgetIconName() => WidgetIconNews::classname(),
            WidgetIconAllNews::getWidgetIconName() => WidgetIconAllNews::classname(),
//            WidgetIconNewsCreatedBy::getWidgetIconName() => WidgetIconNewsCreatedBy::classname(),
//            WidgetIconNewsDaValidare::getWidgetIconName() => WidgetIconNewsDaValidare::classname(),
        ];
    }

    public function searchWidgetIconAllNews()
    {
        $this->query = $this->cwhActiveQuery->getQueryCwhAll();
    }

    /**
     * 
     */
    public function searchWidgetIconNews()
    {
        $this->query = $this->cwhActiveQuery->getQueryCwhOwnInterest();
    }
}