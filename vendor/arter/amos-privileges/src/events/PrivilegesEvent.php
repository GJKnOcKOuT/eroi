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
 * @package    e015\common\events
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\privileges\events;

use yii\base\Event;

/**
 * Class PrivilegesEvent
 * @package arter\amos\privileges\events
 */
class PrivilegesEvent extends Event
{
    /**
     * @var int $userId
     */
    public $userId;

    /**
     * @var string $privilege
     */
    public $privilege;
}
