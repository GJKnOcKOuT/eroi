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
 * @package    arter-mobile-bridge
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\mobile\bridge\modules\v1\models;

use arter\amos\admin\models\UserProfile;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends \arter\amos\core\user\User
{
    /**
     * @return array
     */
    public function fields()
    {
        $fields = parent::fields();
        $fields[] = 'slimProfile';
        $fields[] = 'userImage';
        $fields[] = 'accessToken';
        $fields[] = 'fcmToken';
        return $fields;
    }

    /**
     * @return mixed
     */
    public function getSlimProfile()
    {
        return $this->profile->toArray(
            [
                'nome',
                'cognome',
                'sesso',
                'presentazione_breve'
            ]
        );
    }

    /**
     * @return string
     */
    public function getUserImage()
    {
        $userProfileImage = $this->profile->userProfileImage;

        return $userProfileImage ? $userProfileImage->getWebUrl('original', true) : '';
    }

    public function getAccessToken() {
        $token = AccessTokens::findOne(['user_id' => $this->id]);

        return $token->access_token;
    }

    public function getFcmToken() {
        $token = AccessTokens::findOne(['user_id' => $this->id]);

        return $token->fcm_token;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        $Token = AccessTokens::findOne(['access_token' => $token]);

        if ($Token) {
            return $Token->user;
        }

        return false;
    }

    /**
     * 
     * @param type $deviceToken
     * @param type $deviceOs
     * @return \arter\amos\mobile\bridge\modules\v1\models\AccessTokens
     */
    public function refreshAccessToken($deviceToken, $deviceOs)
    {
        $token = AccessTokens::find()->andWhere(['fcm_token' => $deviceToken])
            ->andWhere([ 'device_os' => $deviceOs])->one();
        if(is_null($token)){
            $token = new AccessTokens();
            $token->user_id = $this->id;
            $token->access_token = \Yii::$app->getSecurity()->generateRandomString();
            $token->fcm_token = $deviceToken;
            $token->device_os = $deviceOs;
            $token->save(false);
        }
        return $token;
    }
}