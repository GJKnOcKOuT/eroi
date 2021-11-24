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
 * @package    arter\amos\notificationmanager\record
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\notificationmanager\record;

/**
 * Interface NotifyRecordInterface
 * @package arter\amos\notificationmanager\record
 */
interface NotifyRecordInterface
{
    /**
     * @return bool
     */
    public function isNews();

    /**
     * @return array
     */
    public function createOrderClause();

    /**
     * @return bool
     */
    public function sendNotification();

    /**
     * @return bool
     */
    public function sendCommunication();
}
