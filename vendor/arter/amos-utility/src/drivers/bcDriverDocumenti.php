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
use arter\amos\documenti\models\Documenti;
use arter\amos\documenti\models\search\DocumentiSearch;
use arter\amos\documenti\widgets\icons\WidgetIconAdminAllDocumenti;
use arter\amos\documenti\widgets\icons\WidgetIconAllDocumenti;
use arter\amos\documenti\widgets\icons\WidgetIconDocumenti;
use arter\amos\documenti\widgets\icons\WidgetIconDocumentiCreatedBy;
use arter\amos\documenti\widgets\icons\WidgetIconDocumentiDaValidare;

/**
 * 
 */
class bcDriverDocumenti extends bcDriver
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->modelClassName  = Documenti::className(); // put here your model
        $this->widgetIconNames = [
//            WidgetIconAdminAllDocumenti::getWidgetIconName() => WidgetIconAdminAllDocumenti::classname(),
            WidgetIconDocumenti::getWidgetIconName() => WidgetIconDocumenti::classname(),
            WidgetIconAllDocumenti::getWidgetIconName() => WidgetIconAllDocumenti::classname(),
//            WidgetIconDocumentiCreatedBy::getWidgetIconName() => WidgetIconDocumentiCreatedBy::classname(),
//            WidgetIconDocumentiDaValidare::getWidgetIconName() => WidgetIconDocumentiDaValidare::classname(),
        ];
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconAdminAllDocumenti()
    {
        $search      = new DocumentiSearch();
        $this->query = $search->buildQuery([], 'admin-all');
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconDocumentiCreatedBy()
    {
        $search      = new DocumentiSearch();
        $this->query = $search->searchCreatedByMeQuery([]);
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconDocumentiDaValidare()
    {
        $search      = new DocumentiSearch();
        $this->query = $search->searchToValidateQuery([]);
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconAllDocumenti()
    {
        $this->query = $this->cwhActiveQuery->getQueryCwhAll();
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconDocumenti()
    {
        $this->query = $this->cwhActiveQuery->getQueryCwhOwnInterest();
    }
}