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
 * @package    arter\amos\core\utilities
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\utilities;

use arter\amos\admin\AmosAdmin;
use Yii;
use yii\base\BaseObject;

class CurrentUser extends BaseObject
{
    static public $user;
    static public $userIdentity;
    static public $userProfile;

    static public function getUser()
    {
        if (!isset(self::$user)) {
            self::$user = Yii::$app->getUser();
        }
        return self::$user;
    }

    static public function getUserIdentity()
    {
        if (!isset(self::$userIdentity)) {
            if (!self::getUser()->getIsGuest()) {
                self::$userIdentity = self::getUser()->getIdentity();
            }
        }

        return self::$userIdentity;
    }

    static public function getUserProfile()
    {
        if (!isset(self::$userProfile)) {
            if (!Yii::$app->getUser()->getIsGuest() && AmosAdmin::instance()) {
                self::$userProfile = self::getUserIdentity()->userProfile;
            }
        }
        return self::$userProfile;
    }

    /**
     *
     * @return boolean
     */
    public static function isPlatformGuest()
    {
        $ret = true;

        if(isset(Yii::$app->params['platformConfigurations']['guestUserId'])) {
            if (!Yii::$app->getUser()->getIsGuest() &&
                (isset(Yii::$app->params['platformConfigurations']['guestUserId']) ? Yii::$app->getUser()->id
                    != Yii::$app->params['platformConfigurations']['guestUserId'] : false)) {
                $ret = false;
            }
        }else {
            $ret = \Yii::$app->user->isGuest;
        }

        return $ret;
    }
}