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
namespace arter\amos\core\models;

use arter\amos\core\user\User;
use UserHelper;
use yii\db\Expression;

class AccessTokens extends \arter\amos\core\models\base\AccessTokens
{

    public static function primaryKey()
    {
        return [
            'access_token'
        ];
    }

    public function logout()
    {
        $this->logout_at = new Expression('NOW()');
        $this->logout_by = UserHelper::get()->getId();
        $this->save(false);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
