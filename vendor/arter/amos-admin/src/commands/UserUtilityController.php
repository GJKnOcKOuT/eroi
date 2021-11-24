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
 * @package    arter\amos\admin\commands
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\admin\commands;

use arter\amos\admin\AmosAdmin;
use arter\amos\core\user\User;
use yii\console\Controller;
use Yii;

class UserUtilityController  extends Controller
{


    /**
     *
     */
    public function actionBasicUserAssign(){
        /** @var AmosAdmin $admin */
        $admin = AmosAdmin::instance();
        $userClass = $admin->model('User');
        $users = $userClass::find()->all();
        /** @var User $user */
        foreach ($users as $user){
            $roles = Yii::$app->authManager->getAssignments($user->id);
            if(empty($roles)) {
                Yii::$app->getAuthManager()->assign(Yii::$app->getAuthManager()->getRole('BASIC_USER'), $user->id);
                $this->log ('Add BASIC_USER to : id'. $user->id . "  username: " . $user->username);
            }
        }
    }

    /**
     * @param $message
     */
    private function log($message){
        echo ($message ."\n");
    }
}