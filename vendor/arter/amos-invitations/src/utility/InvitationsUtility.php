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
 * @package    arter\amos\invitations\utility
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\invitations\utility;

use arter\amos\core\user\User;
use arter\amos\invitations\Module;
use yii\base\BaseObject;
use yii\web\Application;

/**
 * Class InvitationsUtility
 * @package arter\amos\invitations\utility
 */
class InvitationsUtility extends BaseObject
{
    /**
     * Checks if a user is already present in the platform and set
     * @param string $email User email
     * @param bool $disableFlashMessage If true the method don't add a flash message in case of user present.
     * @param bool $returnArray If true return an array with key "present" boolean and key "message" with the same message as flash message.
     * @return bool|array
     */
    public static function checkUserAlreadyPresent($email, $disableFlashMessage = false, $returnArray = false)
    {
        $present = false;
        $message = '';
        $user = User::findByEmail($email);
        if (!is_null($user)) {
            $message = Module::t('amosinvitations', '#user_already_present', ['email' => $email]);
            if (!$disableFlashMessage && !$returnArray && (\Yii::$app instanceof Application)) {
                \Yii::$app->getSession()->addFlash('danger', $message);
            }
            $present = true;
        }
        if (!$present) {
            $user = User::findByEmailInactive($email);
            if (!is_null($user)) {
                $message = Module::t('amosinvitations', '#user_already_present_inactive', ['email' => $email]);
                if (!$disableFlashMessage && !$returnArray && (\Yii::$app instanceof Application)) {
                    \Yii::$app->getSession()->addFlash('danger', $message);
                }
                $present = true;
            }
        }
        if ($returnArray) {
            return ['present' => $present, 'message' => $message];
        } else {
            return $present;
        }
    }
}
