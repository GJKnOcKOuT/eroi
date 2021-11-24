<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


namespace arter\amos\admin\models;

use arter\amos\core\forms\editors\DateTime;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "token_users".
 */
class TokenUsers extends \arter\amos\admin\models\base\TokenUsers
{
    public function representingColumn()
    {
        return [
            //inserire il campo o i campi rappresentativi del modulo
        ];
    }

    public function attributeHints()
    {
        return [
        ];
    }

    /**
     * Returns the text hint for the specified attribute.
     * @param string $attribute the attribute name
     * @return string the attribute hint
     * @see attributeHints
     */
    public function getAttributeHint($attribute)
    {
        $hints = $this->attributeHints();
        return isset($hints[$attribute]) ? $hints[$attribute] : null;
    }

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
        ]);
    }

    public function attributeLabels()
    {
        return
            ArrayHelper::merge(
                parent::attributeLabels(),
                [
                ]);
    }


    public static function getEditFields()
    {
        $labels = self::attributeLabels();

        return [
            [
                'slug' => 'token_group_id',
                'label' => $labels['token_group_id'],
                'type' => 'integer'
            ],
            [
                'slug' => 'user_id',
                'label' => $labels['user_id'],
                'type' => 'integer'
            ],
            [
                'slug' => 'token',
                'label' => $labels['token'],
                'type' => 'string'
            ],
            [
                'slug' => 'used',
                'label' => $labels['used'],
                'type' => 'integer'
            ],
        ];
    }



    /**
     * @param $user_id
     * @param $token_group_id
     */
    public function generateToken($user_id = '', $group_id = ''){
        $date = new \DateTime();
        $timestamp = $date->getTimestamp();
        $hash = md5($timestamp.$user_id.$group_id);
        $this->token = $hash;
    }

    /**
     * @return bool
     */
    public function isTokenExpired(){
        $tokenGroup = $this->tokenGroup;
        if($tokenGroup){
            if(!empty($tokenGroup->expire_date)){
                $expireDate = new \DateTime($tokenGroup->expire_date);
                $now = new \DateTime();
                return ($now > $expireDate);
            }
        }
        return false;
    }

    /**
     * @return bool
     */
    public function hasExceededAccess(){
        $tokenGroup = $this->tokenGroup;
        if($tokenGroup){
            if($tokenGroup->consumable > 0){
                return ($this->used >= $tokenGroup->consumable);
            }
        }
        return false;
    }

    /**
     * @return string
     */
    public function getBackendTokenLink(){
        $url = '';
        $backendUrl = \Yii::$app->params['platform']['backendUrl'];
        if(!empty($backendUrl)) {
            $url = $backendUrl . '/admin/security/login?token=' . $this->token;
        }
        return $url;
    }
}
