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
 * @package    arter\amos\community\widgets\graphics
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\community\widgets\graphics;

use arter\amos\community\AmosCommunity;
use arter\amos\community\models\search\CommunitySearch;
use arter\amos\core\widget\WidgetGraphic;
use arter\amos\notificationmanager\base\NotifyWidgetDoNothing;

/**
 * Class WidgetGraphicsMyCommunities
 * @package arter\amos\community\widgets\graphics
 */
class WidgetGraphicsCommunitiesRecommended extends WidgetGraphic
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
        $this->setCode('COMMUNITIES_RECOMMENDED_GRAPHIC');
        $this->setLabel(AmosCommunity::t('amoscommunity', 'Communities Recommended'));
        $this->setDescription(AmosCommunity::t('amoscommunity', 'View the list of communities recommended'));
    }
    
    /**
     * @return string
     */
    public function getHtml()
    {
        $search = new CommunitySearch();
        $search->setNotifier(new NotifyWidgetDoNothing());
        
        $viewPath = '@vendor/arter/amos-community/src/widgets/graphics/views/';
        $viewToRender = $viewPath . 'communities_recommended';

        if(isset(\Yii::$app->params['WidgetGraphicsCommunitiesRecommended_limit']))
        {
            $numberToView = \Yii::$app->params['WidgetGraphicsCommunitiesRecommended_limit'];
        }else{
            $numberToView = 3;
        }
        if (is_null(\Yii::$app->getModule('layout'))) {
            $viewToRender .= '_old';
        }
        
        /** show subcommunities if you are inside a community and if you have anabled show subcommunities */
        $moduleCommunity = \Yii::$app->getModule('community');
        $showSubscommunities = $moduleCommunity->showSubcommunities;
        $linkToSubcommunities = false;
        /** @var \arter\amos\cwh\AmosCwh $moduleCwh */
        if ($showSubscommunities) {
            $moduleCwh = \Yii::$app->getModule('cwh');
            if (!is_null($moduleCwh)) {
                $scope = $moduleCwh->getCwhScope();
                if (!empty($scope) && isset($scope['community'])) {
                    $search->subcommunityMode = true;
                    $linkToSubcommunities = true;
                }
            }
        }
        
        $communitiesList = $search->searchCommunitiesRecommended($_GET, $numberToView);
       
        return $this->render(
            $viewToRender,
            [ 
                'communitiesList' => $communitiesList,
                'widget' => $this,
                'toRefreshSectionId' => 'widgetGraphicsCommunitiesRecommended',
                'linkToSubcommunities' => $linkToSubcommunities
            ]
        );
    }
}
