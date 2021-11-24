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
 * @package    arter\amos\core\forms
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\forms;

use arter\amos\core\module\Module;
use Yii;
use yii\base\Model;
use common\models\User;
use kartik\password\StrengthValidator;
use yii\helpers\ArrayHelper;



/**
 * First-Login form
 */
class FirstAccessForm extends Model
{

    const SCENARIO_CHECK_PRIVACY = 'check-privacy';
    /**
     * @var string Username
     */
    public $username;

    /**
     * @var string Password
     */
    public $password;

    /**
     * @var string Repeated Password
     */
    public $ripetiPassword;

    /**
     * @var string Password-reset token
     */
    public $token;

    /**
     * @var integer Privacy
     */
    public $privacy;

    private $_user = false;

    public function scenarios()
    {
        $parentScenarios = parent::scenarios();
        $scenarios = ArrayHelper::merge(
            $parentScenarios,
            [
                self::SCENARIO_CHECK_PRIVACY => ['username','password', 'ripetiPassword', 'privacy']
            ]
        );
        return $scenarios;
    }

    /**
     * Define Properties rules
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'ripetiPassword'], 'safe'],
            [['password'], StrengthValidator::className(), 'min' => 8, 'preset' => 'normal', 'userAttribute' => 'username'],
            ['ripetiPassword', 'compare', 'compareAttribute' => 'password', 'message' => \Yii::t('amoscore',"#first_access_pwd_compare_alert")],
            [['username'], 'required'],
            [['password'], 'required', 'message' => \Yii::t('amoscore',"#first_access_pwd_alert")],
            [['privacy'], 'required', 'requiredValue' => 1, 'message' => Module::t('amoscore', "#first_access_privacy_alert_not_accepted") ,'on' => self::SCENARIO_CHECK_PRIVACY],
            [['ripetiPassword'], 'required', 'message' => \Yii::t('amoscore',"#first_access_pwd_2_alert")],
            [['token'], 'string']
    ];
    }


    /**
     * Find User by Username
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

    /**
     * Check Username existence
     * @param string $username Username
     * @return User|null
     */
    public function verifyUsername($username)
    {
        $user = new User();
        $verifyUsername = $user->findOne(['username' => $username]);
        return $verifyUsername;
    }
}
