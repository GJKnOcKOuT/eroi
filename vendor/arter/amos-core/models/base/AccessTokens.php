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
namespace arter\amos\core\models\base;

use arter\amos\core\module\BaseAmosModule;
use Yii;

/**
 * This is the model class for table "access_tokens".
 *
 */
class AccessTokens extends \arter\amos\core\record\Record
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'access_tokens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'logout_by', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['device_info'], 'string'],
            [['logout_at', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['access_token', 'ip'], 'string', 'max' => 32],
            [['location'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'access_token' => BaseAmosModule::t('amoscore', 'Access Token'),
            'user_id' => BaseAmosModule::t('amoscore', 'User id'),
            'device_info' => BaseAmosModule::t('amoscore', 'Device info'),
            'ip' => BaseAmosModule::t('amoscore', 'IP info'),
            'location' => BaseAmosModule::t('amoscore', 'Location'),
            'logout_at' => BaseAmosModule::t('amoscore', 'Logout At'),
            'logout_by' => BaseAmosModule::t('amoscore', 'Logout By'),
            'created_at' => BaseAmosModule::t('amoscore', 'Created At'),
            'created_by' => BaseAmosModule::t('amoscore', 'Created By'),
            'updated_at' => BaseAmosModule::t('amoscore', 'Updated At'),
            'updated_by' => BaseAmosModule::t('amoscore', 'Updated By'),
            'deleted_at' => BaseAmosModule::t('amoscore', 'Deleted At'),
            'deleted_by' => BaseAmosModule::t('amoscore', 'Deleted By'),
        ];
    }
}
