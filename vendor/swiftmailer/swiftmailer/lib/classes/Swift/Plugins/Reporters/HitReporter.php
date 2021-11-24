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


/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * A reporter which "collects" failures for the Reporter plugin.
 *
 * @author Chris Corbyn
 */
class Swift_Plugins_Reporters_HitReporter implements Swift_Plugins_Reporter
{
    /**
     * The list of failures.
     *
     * @var array
     */
    private $failures = [];

    private $failures_cache = [];

    /**
     * Notifies this ReportNotifier that $address failed or succeeded.
     *
     * @param string $address
     * @param int    $result  from {@link RESULT_PASS, RESULT_FAIL}
     */
    public function notify(Swift_Mime_SimpleMessage $message, $address, $result)
    {
        if (self::RESULT_FAIL == $result && !isset($this->failures_cache[$address])) {
            $this->failures[] = $address;
            $this->failures_cache[$address] = true;
        }
    }

    /**
     * Get an array of addresses for which delivery failed.
     *
     * @return array
     */
    public function getFailedRecipients()
    {
        return $this->failures;
    }

    /**
     * Clear the buffer (empty the list).
     */
    public function clear()
    {
        $this->failures = $this->failures_cache = [];
    }
}
