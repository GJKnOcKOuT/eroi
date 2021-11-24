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
use arter\amos\community\models\Community;
use arter\amos\community\models\search\CommunitySearch;
use arter\amos\community\widgets\icons\WidgetIconAdminAllCommunity;
use arter\amos\community\widgets\icons\WidgetIconCommunity;
use arter\amos\community\widgets\icons\WidgetIconCreatedByCommunities;
use arter\amos\community\widgets\icons\WidgetIconMyCommunities;
use arter\amos\community\widgets\icons\WidgetIconMyCommunitiesWithTags;
use arter\amos\community\widgets\icons\WidgetIconToValidateCommunities;

/**
 * 
 */
class bcDriverCommunity extends bcDriver
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->modelClassName  = Community::classname(); // put here your model
        $this->widgetIconNames = [
//            WidgetIconAdminAllCommunity::getWidgetIconName() => WidgetIconAdminAllCommunity::classname(),
            WidgetIconMyCommunities::getWidgetIconName() => WidgetIconMyCommunities::classname(),
            WidgetIconCommunity::getWidgetIconName() => WidgetIconCommunity::classname(),
//            WidgetIconCreatedByCommunities::getWidgetIconName() => WidgetIconCreatedByCommunities::classname(),
//            WidgetIconMyCommunitiesWithTags::getWidgetIconName() => WidgetIconMyCommunitiesWithTags::classname(),
//            WidgetIconToValidateCommunities::getWidgetIconName() => WidgetIconToValidateCommunities::classname()
        ];
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconAdminAllCommunity()
    {

        $search      = new CommunitySearch();
        $this->query = $search->buildQuery([], 'admin-all', false, $this->user_id);
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconCommunity()
    {

        $search      = new CommunitySearch();
        $this->query = $search->buildQuery([], 'all', false, $this->user_id);
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconCreatedByCommunities()
    {

        $search      = new CommunitySearch();
        $this->query = $search->buildQuery([], 'created-by', false, $this->user_id);
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconMyCommunities()
    {

        $search      = new CommunitySearch();
        $this->query = $search->buildQuery([], 'own-interest', false, $this->user_id);
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconMyCommunitiesWithTags()
    {

        $search      = new CommunitySearch();
        $this->query = $search->buildQuery([], 'own-interest-with-tags', false, $this->user_id);
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconToValidateCommunities()
    {
        $search      = new CommunitySearch();
        $this->query = $search->buildQuery([], 'to-validate', false, $this->user_id);
    }
}