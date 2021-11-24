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


namespace arter\amos\core\interfaces;

use arter\amos\core\user\User;
use yii\db\ActiveQuery;

interface NotificationPersonalizedQueryInterface
{

    /**
     * Method used to get the notification records
     * @param $user User
     * @param $cwhActiveQuery ActiveQuery
     * @return ActiveQuery
     */
    public function getNotificationQuery($user ,$cwhActiveQuery);

    /**
     * @param $user User
     * @param $cwhActiveQuery ActiveQuery
     * @return ActiveQuery
     */
    public function canSaveNotification();
}