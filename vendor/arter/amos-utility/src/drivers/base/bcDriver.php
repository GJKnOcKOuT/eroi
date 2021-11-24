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

namespace arter\amos\utility\drivers\base;

use arter\amos\notificationmanager\models\NotificationChannels;
use arter\amos\utility\interfaces\bcDriverInterface;
use arter\amos\utility\models\UpdateContents;
use arter\amos\utility\models\BulletCounters;
use Yii;
use yii\db\Query;
use yii\db\Expression;
use yii\helpers\Console;
use yii\log\Logger;
use yii\base\BaseObject;

class bcDriver extends \yii\base\BaseObject implements bcDriverInterface
{
    /**
     * @var
     */
    public $widgetIconNames;

    /**
     *
     * @var type 
     */
    public $user_id;

    /**
     * @var type 
     */
    public $module;

    /**
     *
     * @var type 
     */
    public $modelClassName;

    /**
     *
     * @var type 
     */
    public $query;

    /**
     *
     * @var type 
     */
    public $cwhActiveQuery;

    /**
     *
     * @var type 
     */
    public $counter;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->modelClassName  = null;
        $this->query           = null;
        $this->widgetIconNames = [];
        $this->counter         = 0;

        $tableName = $this->module;
        if ($this->module == 'admin') {
            $tableName = 'user';
        } else if ($this->module == 'partnershipprofiles') {
            $tableName = 'partnership_profiles';
        } else if ($this->module == 'events') {
            $tableName = 'event';
        } else if ($this->module == 'discussioni') {
            $tableName = 'discussioni_topic';
        } else if ($this->module == 'organizzazioni') {
            $tableName = 'profilo';
        }
        $modelsEnabled = \arter\amos\cwh\models\CwhConfigContents::find()
                ->addSelect('tablename, classname')
                ->andWhere(['tablename' => $tableName])
            ->asArray()
            ->one();
      
        if (!(empty($modelsEnabled))) {
            $this->cwhActiveQuery               = new \arter\amos\cwh\query\CwhActiveQuery(
                $modelsEnabled['classname'],
                [
                'queryBase' => $modelsEnabled['classname']::find(),
                'userId' => $this->user_id
                ]
            );
            $this->cwhActiveQuery::$userProfile = null; //reset user profile
        }
    }

    /**
     * @inheritdoc
     */
    public function calculateBulletCounters()
    {
//        $logMessage = 'User: ' . $this->user_id . ' - Macro area: ' . $this->module;
        $i = count($this->widgetIconNames);
        $a = 0;
        foreach ($this->widgetIconNames as $widget => $namespace) {
            try {
                $a++;
                call_user_func_array([$this, 'search'.$widget], []);

                $this->counter += $this->updateBulletCounters($widget, $namespace, ($i == $a ? true : false));
            } catch (Exception $ex) {
                Yii::getLogger()->log($ex->getMessage(), \yii\log\Logger::LEVEL_ERROR);
            }
        }
    }

    /**
     * 
     * @param type $widget
     */
    public function updateBulletCounters($widget = null, $namespace = null, $reset = false)
    {
        // Nothing to do!
        if ($this->query == null) {
            return 0;
        }

        $counter  = 0;
        $notifier = Yii::$app->getModule('notify');
        if ($notifier) {
            $counter = $notifier->countNotRead(
                $this->user_id, $this->modelClassName, $this->query
            );

            /**
             * Something was changed?
             */
            if ($counter > 0 && $reset == true) {
                // Turn off counter
                $notifier->notificationOff(
                    $this->user_id, $this->modelClassName, $this->query, NotificationChannels::CHANNEL_READ
                );
            }
            $this->updateBulletCountersTable($this->user_id, $this->module, $namespace, $counter);
        }

        return $counter;
    }

    /**
     * Update bullet counter table for specified user
     * @param type $namespace
     */
    public static function updateBulletCountersTable($user_id = null, $moduleName, $namespace = null, $counter = 0,
                                                     $forceValue = false)
    {
        if ($counter < 0) {
            $counter = 0;
        }

        $wid = BulletCounters::getAmosWidgetsIconNameID($moduleName, $namespace);

        $modelObj = BulletCounters::find()
            ->andWhere([
                'widget_icon_id' => $wid['id'],
                'user_id' => $user_id
            ])
            ->one();

        if (empty($modelObj)) {
            $modelObj = new BulletCounters();
        }

        if ($forceValue == true) {
            $modelObj->user_id        = $user_id;
            $modelObj->widget_icon_id = $wid['id'];
            $modelObj->counter        = $counter; // Check if it's correct or not
            $modelObj->pre_counter    = $counter; // Check if it's correct or not          
            $modelObj->microtime      = 0;
        } else {
            $modelObj->user_id        = $user_id;
            $modelObj->widget_icon_id = $wid['id'];
            $modelObj->counter        = $modelObj->counter + $counter; // Check if it's correct or not
            $modelObj->pre_counter    = $modelObj->counter; // Check if it's correct or not
            $modelObj->microtime      = 0;
        }
        $modelObj->save();
    }
}