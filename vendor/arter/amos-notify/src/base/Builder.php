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
 * @package    arter\amos\notificationmanager\base
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\notificationmanager\base;

use arter\amos\core\user\User;

/**
 * Interface Builder
 * @package arter\amos\notificationmanager\base
 */
interface Builder
{
    /**
     * @param array $resultset
     * @param User $user
     * @return string
     */
    public function renderEmail(array $resultset, User $user);

    /**
     * @param array $resultset
     * @return string
     */
    public function getSubject(array $resultset);

    /**
     * @param array $resultSetNormal
     * @param array $resultSetNetwork
     * @param User $user
     * @return mixed
     */
}
