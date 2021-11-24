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
 * @package    arter\amos\chat
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\chat\models\base;

use arter\amos\chat\AmosChat;
use arter\amos\core\helpers\Html;
use Yii;
use yii\base\NotSupportedException;
use arter\amos\admin\AmosAdmin;

/**
 * Class User
 * @package arter\amos\chat\models\base
 *
 * @property \arter\amos\admin\models\UserProfile $profile
 */
class User extends \arter\amos\core\user\User
{
    private $_name;

    /**
     * @return static[]
     */
    public static function getAll($asArray = false)
    {
        if($asArray){
            return User::find()->with('userProfile')->asArray()->all();
        }
        else{
            return User::find()->with('userProfile')->all();
        }
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException(get_called_class() . ' ' . AmosChat::t('amoschat', 'non supporta') . ' findIdentityByAccessToken().');
    }

    /**
     * @return null|\yii\db\ActiveQuery
     */
    public function getUserProfile()
    {
        if ($this->adminInstalled) {
            return $this->hasOne(AmosAdmin::instance()->createModel('UserProfile')->className(), ['user_id' => 'id']);
        } else
            return NULL;
    }

    /**
     * @return string
     */
    public function getName()
    {
        if ((null === $this->_name) && (isset($this->profile))) {
            $this->_name = $this->profile->cognome . ' ' . $this->profile->nome;
        }
        return $this->_name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return null|\yii\db\ActiveQuery
     */
    public function getProfile()
    {
        if ($this->adminInstalled) {
            return $this->hasOne(AmosAdmin::instance()->createModel('UserProfile')->className(), ['user_id' => 'id']);
        } else {
            return null;
        }
    }

    /**
     * @return string
     */
    public function getAvatar()
    {
        $model = $this->profile;
        if(!$model){
            return $this->getDefaultProfileAvatar();
        }
        $roundImage = Yii::$app->imageUtility->getRoundImage($model);
        return  Html::img($model->getAvatarUrl('square_small'), [
                'class' => $roundImage['class'],
                'style' => "margin-left: " . $roundImage['margin-left'] . "%; margin-top: " . $roundImage['margin-top'] . "%;",
                'alt' => $model->getNomeCognome()
            ]
        );
    }

    protected function getDefaultProfileAvatar()
    {
        return Html::img("/img/defaultProfilo.png", ['width' => '50', 'class' => 'media-object avatar']);
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
        return true;
    }
}
