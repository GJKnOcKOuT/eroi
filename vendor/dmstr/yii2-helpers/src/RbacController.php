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

/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2017 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\helpers;

use yii\console\Controller;

class RbacController extends Controller
{
    /**
     * Assign role to user
     *
     * @param $roleName
     * @param $userName
     */
    public function actionAssign($roleName, $userName)
    {
        $userModel = new \Yii::$app->user->identityClass;
        $user = $userModel::find()->where(['username' => $userName])->one();
        $manager = \Yii::$app->authManager;
        if (\in_array($user->id, $manager->getUserIdsByRole($roleName))) {
            $this->stdout('Role is already assigned to this user'.PHP_EOL);
            $this->stdout(PHP_EOL.PHP_EOL.'Aborted.'.PHP_EOL);
        } else {
            $role = $manager->getRole($roleName);
            $manager->assign($role, $user->id);
            $this->stdout('Role has been assigned');
            $this->stdout(PHP_EOL.PHP_EOL.'Done.'.PHP_EOL);
        }
    }

    /**
     * Revoke role from user
     *
     * @param $roleName
     * @param $userName
     */
    public function actionRevoke($roleName, $userName)
    {
        $userModel = new \Yii::$app->user->identityClass;
        $user = $userModel::find()->where(['username' => $userName])->one();
        $manager = \Yii::$app->authManager;
        $role = $manager->getRole($roleName);
        $manager->revoke($role, $user->id);
        $this->stdout('Role has been revoked');
        $this->stdout(PHP_EOL.PHP_EOL.'Done.'.PHP_EOL);
    }
}