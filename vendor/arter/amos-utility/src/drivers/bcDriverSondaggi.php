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
use arter\amos\sondaggi\models\Sondaggi;
use arter\amos\sondaggi\models\search\SondaggiSearch;
use arter\amos\sondaggi\widgets\icons\WidgetIconSondaggi;
use arter\amos\sondaggi\widgets\icons\WidgetIconCompilaSondaggiOwnInterest;
use arter\amos\sondaggi\widgets\icons\WidgetIconCompilaSondaggiAll;

/**
 * 
 */
class bcDriverSondaggi extends bcDriver
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->modelClassName  = Sondaggi::classname(); // put here your model
        $this->widgetIconNames = [
//            WidgetIconSondaggi::getWidgetIconName() => WidgetIconSondaggi::classname(),
            WidgetIconCompilaSondaggiOwnInterest::getWidgetIconName() => WidgetIconCompilaSondaggiOwnInterest::classname(),
            WidgetIconCompilaSondaggiAll::getWidgetIconName() => WidgetIconCompilaSondaggiAll::classname(),
        ];
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconCompilaSondaggiOwnInterest()
    {
        $search      = new SondaggiSearch();
        $this->query = $search->searchOwnInterest([])->query;
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconCompilaSondaggiAll()
    {
        $search      = new SondaggiSearch();
        $this->query = $search->searchAll([])->query;
    }
}