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
 * @package    arter\amos\core\bootstrap
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\bootstrap;

use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\base\WidgetEvent;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

/**
 * Class Breadcrumb
 * @package arter\amos\core\bootstrap
 */
class Breadcrumb implements BootstrapInterface
{
    /**
     * @var string
     */
    public $activeBreadcrumbHelperClass = "arter\\amos\\core\\helpers\\BreadcrumbHelper";

    /**
     * @param $app
     */
    public function bootstrap($app)
    {
        Event::on(Breadcrumbs::className(), Breadcrumbs::EVENT_BEFORE_RUN, [$this, 'modifyBreadcrumbs']);
    }

    /**
     * @param WidgetEvent $event
     */
    public function modifyBreadcrumbs(WidgetEvent $event)
    {
        /**
         * set up breadcrumb helper
         */
        $helperClass = \Yii::createObject($this->activeBreadcrumbHelperClass);

        /**
         * retrieve label
         */
        $lbl = end($event->sender->links);
        $result = reset($event->sender->links);
        if (is_object($lbl) && method_exists($lbl, '__toString')) {
            $lbl = $lbl->__toString();
        }
        $label = isset($lbl['label']) ? $lbl['label'] : $lbl;
        $hidden = isset($lbl['hidden']) ? $lbl['hidden'] : false;
        $template = isset($result['template']) ? $result['template'] : null;
        $remove_action = isset($result['remove_action']) ? $result['remove_action'] : null;

        /**
         * add crumb and generate cache again
         */
        if (!$hidden) {
            $helperClass::add($label, Url::current(), $template, $remove_action);
        }
        $trail = $helperClass->renderCrumbs();

        /**
         * if label is empty log in into breadcrumbs log
         */
        if (empty($label)) {
            /**
             * set logger stack info to zero
             */
            \Yii::getLogger()->traceLevel = 0;
            /**
             * log missing label
             */
            \Yii::info($trail, 'Breadcrumb');
        }

        /**
         * send cache to breadcrumb widget
         */
        //pr($trail,"Trail");
        $event->sender->links = $trail;
    }
}
