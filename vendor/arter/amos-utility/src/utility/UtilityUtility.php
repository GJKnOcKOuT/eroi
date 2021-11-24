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
 * @package    arter\amos\utility\utility
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\utility\utility;

use arter\amos\admin\models\UserProfile;
use arter\amos\core\user\User;
use yii\db\Query;

/**
 * Class UtilityUtility
 * @package arter\amos\utility\utility
 */
class UtilityUtility
{
    /**
     * This method returns an array indexed by user ids and the values are name and surname.
     * The users are active and not deleted.
     * @return array
     */
    public static function getUsersToImpersonate()
    {
        $userProfileTable = UserProfile::tableName();
        $userTable = User::tableName();
        $query = new Query();
        $query->select(["CONCAT(" . $userProfileTable . ".nome, ' ', " . $userProfileTable . ".cognome, ' - userId: ', " . $userProfileTable . ".user_id, ' - userProfileId: ', " . $userProfileTable . ".id) AS userNameSurname"]);
        $query->from($userTable);
        $query->innerJoin($userProfileTable, $userProfileTable . '.user_id = ' . $userTable . '.id');
        $query->andWhere([$userTable . '.deleted_at' => null]);
        $query->andWhere([$userProfileTable . '.deleted_at' => null]);
        $query->andWhere([$userTable . '.status' => User::STATUS_ACTIVE]);
        $query->andWhere([$userProfileTable . '.attivo' => UserProfile::STATUS_ACTIVE]);
        $query->andWhere(['not like', 'email', '#deleted_']);
        $query->andWhere(['<>', $userTable . '.id', \Yii::$app->user->id]);
        $query->indexBy('id');
        $usersToImpersonate = $query->column();
        return $usersToImpersonate;
    }
}
