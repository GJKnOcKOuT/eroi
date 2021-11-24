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
 * @package    arter\amos\socialauth\utility
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\socialauth\utility;

use arter\amos\admin\models\UserProfile;
use arter\amos\socialauth\models\SocialIdmUser;
use yii\base\Event;

/**
 * Class SocialAuthUtility
 * @package arter\amos\socialauth\utility
 */
class SocialAuthUtility
{
    /**
     * This method takes an array of UserProfile objects and return an array with user id in the key and name, surname and email in the value.
     * @param UserProfile[] $userProfiles
     * @return array
     */
    public static function makeUsersByCFReadyForSelect($userProfiles)
    {
        $readyForSelect = [];
        foreach ($userProfiles as $userProfile) {
            $readyForSelect[$userProfile->user_id] = $userProfile->getNomeCognome() . ' (' . $userProfile->user->email . ')';
        }
        return $readyForSelect;
    }

    /**
     * This method takes an array of UserProfile objects and return an array with user id in the key and name, surname and email in the value.
     * @param UserProfile[] $userProfiles
     * @return array
     */
    public static function makeUsersByCFUserIds($userProfiles)
    {
        $userIds = [];
        foreach ($userProfiles as $userProfile) {
            $userIds[$userProfile->user_id] = $userProfile->user_id;
        }
        return $userIds;
    }

    /**
     * @param $userDatas
     * @return bool
     */
    public static function createIdmUser($userDatas, $user_id = null)
    {
        $userId = (!\Yii::$app->user->isGuest ? \Yii::$app->user->id : 0);

        if(!empty($user_id)){
            $userId = $user_id;
        }

        $ok = true;

        if ($userDatas instanceof Event) {
            $userProfile = $userDatas->sender;
            if (!is_null($userProfile) && ($userProfile instanceof UserProfile)) {
                $userId = $userProfile->user_id;
            }
            $userDatas = \Yii::$app->session->get('IDM');

            if (
                !$userDatas ||
                is_null(\Yii::$app->request->get('from-shibboleth')) ||
                (!is_null(\Yii::$app->request->get('from-shibboleth')) && (\Yii::$app->request->get('from-shibboleth') == 0))
            ) {
                return false;
            }
        }

        // Update codice fiscale
        self::updateFiscalCode($userId, $userDatas['codiceFiscale']);

        $socialIdmUser = SocialIdmUser::findOne([
            'numeroMatricola' => $userDatas['matricola'],
            'emailAddress' => $userDatas['emailAddress'],
            'codiceFiscale' => $userDatas['codiceFiscale'],
            'user_id' => $userId,
        ]);

        if (is_null($socialIdmUser)) {
            $socialIdmUser = new SocialIdmUser();
            $socialIdmUser->numeroMatricola = $userDatas['matricola'];
            $socialIdmUser->nome = $userDatas['nome'];
            $socialIdmUser->cognome = $userDatas['cognome'];
            $socialIdmUser->emailAddress = $userDatas['emailAddress'];
            $socialIdmUser->codiceFiscale = $userDatas['codiceFiscale'];
            $socialIdmUser->user_id = $userId;
        }

        $socialIdmUser->accessMethod = reset($userDatas['rawData']['saml_attribute_originedatiutente']);
        $socialIdmUser->accessLevel = reset($userDatas['rawData']['saml_attribute_tipoautenticazione']);
        $socialIdmUser->rawData = serialize($userDatas['rawData']);
        $ok = $socialIdmUser->save(false);

        //Remove session data
        \Yii::$app->session->remove('IDM');

        return $ok;
    }

    /**
     * @param int $userId
     * @param string $fiscalCode
     * @return bool
     */
    public static function updateFiscalCode($userId, $fiscalCode)
    {
        $user = UserProfile::findOne(['user_id' => $userId]);
        $user->codice_fiscale = $fiscalCode;
        return $user->save(false);
    }
}
