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
 * @package    arter\amos\discussioni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\discussioni\widgets\icons;

use arter\amos\core\widget\WidgetIcon;
use arter\amos\core\widget\WidgetAbstract;
use arter\amos\core\icons\AmosIcons;
use arter\amos\dashboard\models\AmosUserDashboards;
use arter\amos\dashboard\models\AmosUserDashboardsWidgetMm;
use arter\amos\dashboard\models\AmosWidgets;
use arter\amos\discussioni\AmosDiscussioni;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Application as Web;

/**
 * Class WidgetIconDiscussioni
 * This widget can appear on dashboard. This class is used for creation and general configuration.
 * widget that link to the discussion dashboard
 * @deprecated
 * @package arter\amos\discussioni\widgets\icons
 */
class WidgetIconDiscussioni extends WidgetIcon
{

    /**
     * Init of the class, set of general configurations
     */
    public function init()
    {
        parent::init();

        $paramsClassSpan = [
            'bk-backgroundIcon',
            'color-primary'
        ];

        $this->setLabel(AmosDiscussioni::tHtml('amosdiscussioni', 'Discussioni'));
        $this->setDescription(AmosDiscussioni::t('amosdiscussioni', 'Modulo discussioni'));

        if (!empty(Yii::$app->params['dashboardEngine']) && Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
            $this->setIconFramework(AmosIcons::IC);
            $this->setIcon('disc');
            $paramsClassSpan = [];
        } else {
            $this->setIcon('comment');
        }

        $this->setUrl(['/discussioni']);
        $this->setCode('DISCUSSIONI_MODULE_001');
        $this->setModuleName('discussioni-dashboard');
        $this->setNamespace(__CLASS__);

        $this->setClassSpan(
            ArrayHelper::merge(
                $this->getClassSpan(),
                $paramsClassSpan
            )
        );

        if (Yii::$app instanceof Web) {
            $this->setBulletCount(
                $this->makeBulletCounter(
                    Yii::$app->getUser()->getId()
                )
            );
        }
    }

    /**
     * 
     * @param type $userId
     * @param type $className
     * @param type $externalQuery
     * @return type
     */
    public function makeBulletCounter($userId = null, $className = null, $externalQuery = null)
    {
        return $this->getBulletCountChildWidgets($userId);
    }

    /**
     * 
     * @param type $user_id
     * @return int - the sum of bulletCount internal widget
     */
    private function getBulletCountChildWidgets($userId = null)
    {
        /** @var AmosUserDashboards $userModuleDashboard */
        $userModuleDashboard = AmosUserDashboards::findOne([
            'user_id' => $userId,
            'module' => AmosDiscussioni::getModuleName()
        ]);

        if (is_null($userModuleDashboard)) {
            return 0;
        }

        $listWidgetChild = $userModuleDashboard->amosUserDashboardsWidgetMms;
        if (is_null($listWidgetChild)) {
            return 0;
        }

        /** @var AmosUserDashboardsWidgetMm $widgetChild */
        $count = 0;
        
        $classNames = [];
        foreach ($listWidgetChild as $widgetChild) {
            if ($widgetChild->amos_widgets_classname != $this->getNamespace()) {
                $classNames[] = $widgetChild->amos_widgets_classname;
            }
        }
        
        $amosWidgets = AmosWidgets::find([
            'classname' => $classNames,
            'type' => AmosWidgets::TYPE_ICON
        ]);
        
        foreach ($amosWidgets as $widgetChild) {
            $widget = \Yii::createObject($widgetChild->amos_widgets_classname);
            $count += (int)$widget->getBulletCount();
        }

        return $count;
    }

    /**
     * all widgets added to the container object retrieved from the module controller
     * @return array
     */
    public function getOptions()
    {
        return ArrayHelper::merge(
            parent::getOptions(),
            ['children' => $this->getWidgetsIcon()]
        );
    }

    /**
     * @todo TEMPORARY
     */
    public function getWidgetsIcon()
    {
        $widgets = [];

        $WidgetIconDiscussioniTopicc = new WidgetIconDiscussioniTopic();
        if ($WidgetIconDiscussioniTopicc->isVisible()) {
            $widgets[] = $WidgetIconDiscussioniTopicc->getOptions();
        }

        $WidgetIconDiscussioniTopicCreatedBy = new WidgetIconDiscussioniTopicCreatedBy();
        if ($WidgetIconDiscussioniTopicCreatedBy->isVisible()) {
            $widgets[] = $WidgetIconDiscussioniTopicCreatedBy->getOptions();
        }

        return $widgets;
    }

}
