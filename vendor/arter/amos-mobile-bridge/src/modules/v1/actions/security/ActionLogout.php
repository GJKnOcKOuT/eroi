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
 * @package    arter\amos\mobile\bridge
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\mobile\bridge\modules\v1\actions\security;


use common\models\AccessTokens;
use yii\rest\Action;

class ActionLogout extends Action
{

    /**
     * @param $username
     * @return bool
     * @throws \Exception
     */
    public function run()
    {
        try {
            $authHeader = \Yii::$app->getRequest()->getHeaders()->get('Authorization');
            preg_match('/^Bearer\s+(.*?)$/', $authHeader, $matches);

            /**@var $modelClass AccessTokens*/
            $modelClass = $this->modelClass;
            $AccessToken = $modelClass::findOne([
                'access_token' => $matches[1],
                'logout_at' => null
            ]);

            if ($AccessToken) {
                $AccessToken->logout();
            } else {
                throw new \Exception('Impossibile effettuare il logout');
            }

        } catch (\Exception $e) {
            throw new \Exception('Impossibile effettuare il logout');
        }


        return true;
    }

}