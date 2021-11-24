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
 * @package    arter\amos\socialauth\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\socialauth\models;


use arter\amos\core\record\Record;
use arter\amos\socialauth\Module;

/**
 * Class SocialAuthServices
 * @package arter\amos\socialauth\models
 *
 * @property integer $id
 * @property integer $social_users_id
 * @property string $service
 * @property string $access_token
 * @property integer $expires_in
 * @property string $token_type
 * @property string $refresh_token
 * @property integer $token_created
 * @property string $service_id
 *
 * @property SocialAuthUsers $socialUser
 * @property \arter\amos\core\user\User $user
 */
class SocialAuthServices extends Record
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'social_user_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['social_users_id', 'service'], 'required'],
            [[
                'service',
                'access_token',
                'token_type',
                'refresh_token',
                'service_id'
            ],
                'string'
            ],
            [['social_users_id', 'expires_in', 'token_created'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('amossocialauth', 'ID'),
            'social_users_id' => Module::t('amossocialauth', 'Social User Id'),
            'service' => Module::t('amossocialauth', 'Service name'),
            'access_token' => Module::t('amossocialauth', 'Service Access Token'),
            'token_type' => Module::t('amossocialauth', 'Token type'),
            'expires_in' => Module::t('amossocialauth', 'Access token expiration'),
            'refresh_token' => Module::t('amossocialauth', 'Refresh token'),
            'token_created' => Module::t('amossocialauth', 'created_at'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocialUser()
    {
        return $this->hasOne(SocialAuthUsers::className(), ['id' => 'social_users_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\arter\amos\core\user\User::className(), ['id' => 'user_id'])->via('socialUser');
    }
}