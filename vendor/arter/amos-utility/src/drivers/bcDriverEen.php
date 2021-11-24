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
use arter\amos\een\models\EenPartnershipProposal;
use arter\amos\een\models\search\EenPartnershipProposalSearch;
use arter\amos\een\widgets\icons\WidgetIconEen;
use arter\amos\een\widgets\icons\WidgetIconEenAll;
use arter\amos\een\widgets\icons\WidgetIconEenArchived;
use arter\amos\een\widgets\icons\WidgetIconEenExprOfInterest;
use arter\amos\een\widgets\icons\WidgetIconEenExprOfInterestAll;
use arter\amos\een\widgets\icons\WidgetIconEenExprOfInterestReceived;

/**
 * 
 */
class bcDriverProject_management extends bcDriver
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->modelClassName  = EenPartnershipProposal::className(); // put here your model
        $this->widgetIconNames = [
//            WidgetIconEen::getWidgetIconName() => WidgetIconEen::classname(),
//            WidgetIconEenAll::getWidgetIconName() => WidgetIconEenAll::classname(),
//            WidgetIconEenArchived::getWidgetIconName() => WidgetIconEenArchived::classname(),
//            WidgetIconEenExprOfInterest::getWidgetIconName() => WidgetIconEenExprOfInterest::classname(),
//            WidgetIconEenExprOfInterestAll::getWidgetIconName() => WidgetIconEenExprOfInterestAll::classname(),
//            WidgetIconEenExprOfInterestReceived::getWidgetIconName() => WidgetIconEenExprOfInterestReceived::classname(),
        ];
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconEen()
    {
        $search      = new EenPartnershipProposalSearch();
        $this->query = $search->buildQuery([], 'own-interest');
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconEenAll()
    {
        $search      = new EenPartnershipProposalSearch();
        $this->query = $search->buildQuery([], 'all');
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconEenArchived()
    {
        $search      = new EenPartnershipProposalSearch();
        $this->query = $search->buildQuery([], 'archived');
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconEenExprOfInterest()
    {
        $search      = new EenPartnershipProposalSearch();
        $this->query = $search->buildQuery([], 'all');
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconEenExprOfInterestAll()
    {
        $search      = new EenPartnershipProposalSearch();
        $this->query = $search->buildQuery([], 'all');
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconEenExprOfInterestReceived()
    {
        $search      = new EenPartnershipProposalSearch();
        $this->query = $search->buildQuery([], 'all');
    }
}