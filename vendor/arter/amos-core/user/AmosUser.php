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
 * @package    arter\amos\core\user
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\user;

use arter\amos\admin\models\UserProfile;
use arter\amos\core\controllers\BaseController;
use Yii;
use yii\base\Event;
use yii\log\Logger;
use yii\web\User;

/**
 * Class AmosUser
 * @package arter\amos\core\user
 */
class AmosUser extends User
{
    public $identityClass = '\arter\amos\core\user\User';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->on(self::EVENT_AFTER_LOGIN, [$this, 'timeStampLogin']);
        $this->on(self::EVENT_BEFORE_LOGOUT, [$this, 'timeStampLogout']);
        parent::init();
    }

    /**
     * @param Event $event
     */
    public function timeStampLogin($event)
    {
        try {
            /** @var UserProfile $profile */
            $profile = $this->getIdentity()->getProfile();

            if ($profile) {
                if (!(!empty(\Yii::$app->params['performance']) && \Yii::$app->params['performance']
                    == true && \Yii::$app->formatter->asDate($profile->ultimo_accesso,
                        'php:Y-m-d') == date('Y-m-d'))) {
                    $time                    = new \DateTime("now");
                    $profile->ultimo_accesso = Yii::$app->formatter->asDate(
                        $time, 'php:Y-m-d H:i:s'
                    ); // 2014-10-06 15:22:34;
                    $profile->count_logins   = $profile->count_logins + 1;
                    $profile->detachBehavior("TimestampBehavior");
                    $profile->save(false);
                }
            }
        } catch (\Exception $ex) {
            Yii::getLogger()->log($ex->getMessage(), Logger::LEVEL_ERROR);
        }
    }

    /**
     * @param Event $event
     */
    public function timeStampLogout($event)
    {
        try {
            /** @var UserProfile $profile */
            $profile = $this->getIdentity()->getProfile();

            if (!(!empty(\Yii::$app->params['performance']) && \Yii::$app->params['performance']
                == true)) {
                $time                   = new \DateTime("now");
                $profile->ultimo_logout = Yii::$app->formatter->asDate($time,
                    'php:Y-m-d H:i:s'); // 2014-10-06 15:22:34;
                $profile->save(false);
            }
        } catch (\Exception $ex) {
            Yii::getLogger()->log($ex->getMessage(), Logger::LEVEL_ERROR);
        }
    }
    /*
     * @inheritdoc
     */

    public function can($permissionName, $params = [], $allowCaching = true)
    {
        if (empty($params)) {
            $controller = Yii::$app->controller;
            if (!is_null($controller) && $controller instanceof BaseController) {
                $params['model'] = $controller->getModelObj();
            }
        }
        return $can = parent::can($permissionName, $params, $allowCaching);
    }
}