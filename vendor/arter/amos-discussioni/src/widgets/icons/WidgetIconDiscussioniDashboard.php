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
use arter\amos\discussioni\AmosDiscussioni;
use arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopicAll;
use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\web\Application as Web;

/**
 * Class WidgetIconDiscussioni
 * This widget can appear on dashboard. This class is used for creation and general configuration.
 * widget that link to the discussion dashboard
 *
 * @package arter\amos\discussioni\widgets\icons
 */
class WidgetIconDiscussioniDashboard extends WidgetIcon
{
    /*
     * to avoid multiple calling
     */
    
    protected static $_called = false;

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
        $this->setModuleName('discussioni');
        $this->setNamespace(__CLASS__);

        $this->setClassSpan(
            ArrayHelper::merge(
                $this->getClassSpan(),
                $paramsClassSpan
            )
        );

        if (self::$_called === false) {
            self::$_called = true;
            if (Yii::$app instanceof Web) {
                $this->setBulletCount(
                    $this->makeBulletCounter(Yii::$app->getUser()->getId())
                );
            }
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
        $widgetAll = \Yii::createObject(WidgetIconDiscussioniTopicAll::className());

        return $widgetAll->getBulletCount();

//        return $this->getBulletCountChildWidgets($userId);
    }

//    /**
//     * 
//     * @param type $userId
//     * @return int - the sum of bulletCount internal widget
//     */
//    private function getBulletCountChildWidgets($userId = null)
//    {
//        $count = 0;
//        try {
//            /** @var AmosUserDashboards $userModuleDashboard */
//            $userModuleDashboard = AmosUserDashboards::findOne([
//                'user_id' => $userId,
//                'module' => AmosDiscussioni::getModuleName()
//            ]);
//
//            if (is_null($userModuleDashboard)) {
//                return 0;
//            }
//
//            $widgetAll = \Yii::createObject(WidgetIconDiscussioniTopicAll::className());
//            $widgetCreatedBy = \Yii::createObject(WidgetIconDiscussioniTopicCreatedBy::className());
//
//            $count = $widgetAll->getBulletCount() + $widgetCreatedBy->getBulletCount();
//        } catch (Exception $ex) {
//            Yii::getLogger()->log($ex->getMessage(), \yii\log\Logger::LEVEL_ERROR);
//        }
//
//        return $count;
//    }

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
