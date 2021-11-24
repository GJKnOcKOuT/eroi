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
 * @package    arter\amos\ticket\widgets\icons
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\ticket\widgets\icons;

use arter\amos\community\models\Community;
use arter\amos\core\widget\WidgetIcon;
use arter\amos\core\widget\WidgetAbstract;
use arter\amos\core\icons\AmosIcons;
use arter\amos\ticket\AmosTicket;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconTicketDashboard
 * @package arter\amos\ticket\widgets\icons
 */
class WidgetIconTicketDashboard extends WidgetIcon
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $scopeName = '';
        $communityName = $this->getCommunityName();
        if (!empty($communityName)) {
            $scopeName = ' ' . $communityName;
        }
        
        $this->setLabel(AmosTicket::t('amosticket', '#widget_icon_ticket_dashboard_label') . $scopeName);
        $this->setDescription(AmosTicket::t('amosticket', '#widget_icon_ticket_dashboard_description'));

        $paramsClassSpan = [
            'bk-backgroundIcon',
            'color-lightPrimary'
        ];

        if (!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
            $this->setIconFramework(AmosIcons::IC);
            $this->setIcon('assistenza');
            $paramsClassSpan = [];
        } else {
            $this->setIconFramework('dash');
            $this->setIcon('feed');
        }

        $this->setUrl(Yii::$app->urlManager->createUrl(['/ticket']));
        $this->setModuleName('ticket');
        $this->setNamespace(__CLASS__);

        $this->setClassSpan(
            ArrayHelper::merge(
                $this->getClassSpan(),
                $paramsClassSpan
            )
        );
    }

    /**
     * 
     * @return type
     */
    private function getCommunityName()
    {
        $moduleCwh = \Yii::$app->getModule('cwh');
        $moduleCommunity = \Yii::$app->getModule('community');
        if (isset($moduleCwh) && isset($moduleCommunity) && !empty($moduleCwh->getCwhScope())) {

            $scope = $moduleCwh->getCwhScope();
            if (isset($scope['community'])) {
                $community = Community::findOne(['id' => $scope['community']]);
                if (!empty($community)) {
                    return $community->name;
                }
            }
        }

        return null;
    }

}
