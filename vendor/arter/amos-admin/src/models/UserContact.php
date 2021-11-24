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
 * @package    arter\amos\admin\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\admin\models;

use arter\amos\admin\models\base\UserContact as BaseUserContact;

/**
 * Class UserContact
 * @package arter\amos\admin\models
 */
class UserContact extends BaseUserContact
{

    /**
     * Constants for user contant statuses
     */
    const STATUS_INVITED = "INVITED";
    const STATUS_ACCEPTED = "ACCEPTED";
    const STATUS_REFUSED = "REFUSED";

   public function getInvitingUserProfile($userId = null){
       if(is_null($userId)){
           $userId = \Yii::$app->user->id;
       }
       if($this->user_id == $userId) {
           return $this->contactUserProfile;
       }
       return $this->userProfile;
   }

}
