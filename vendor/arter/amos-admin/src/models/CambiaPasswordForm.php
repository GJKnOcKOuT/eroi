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

use arter\amos\core\user\User;
use kartik\password\StrengthValidator;
use Yii;
use yii\base\Model;
use arter\amos\admin\AmosAdmin;


class CambiaPasswordForm extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $vecchiaPassword;
    public $nuovaPassword;
    public $ripetiPassword;
    public $username;

    private $_user = false;

    public function init()
    {
        parent::init();
        $this->username = $this->getUser()->username;
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['vecchiaPassword', 'nuovaPassword', 'ripetiPassword'], 'string'],
            [['vecchiaPassword'], 'validatePassword'],
            [['nuovaPassword'],  StrengthValidator::className(), 'min' => 8, 'digit' => 1, 'special' => 1, 'upper'=> 1, 'lower' => 1, 'userAttribute' => 'username'],
            ['ripetiPassword', 'compare', 'compareAttribute' => 'nuovaPassword', 'message' => 'Le password non coincidono'],
            [['vecchiaPassword', 'nuovaPassword', 'ripetiPassword'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'vecchiaPassword' => AmosAdmin::t('amosadmin', 'Vecchia password'),
            'nuovaPassword' => AmosAdmin::t('amosadmin', 'Nuova password'),
            'ripetiPassword' => AmosAdmin::t('amosadmin', 'Ripeti nuova password'),
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            /**
             * @var $user User
             */
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->vecchiaPassword)) {
                $this->addError($attribute, AmosAdmin::t('amosadmin','Password inserita non coincide con la password attuale.'));
            }
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = AmosAdmin::instance()->createModel('User')->findByUsername(Yii::$app->user->getIdentity()->username);
        }

        return $this->_user;
    }
}

?>
