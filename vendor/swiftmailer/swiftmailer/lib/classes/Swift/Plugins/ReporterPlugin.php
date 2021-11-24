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
 * Does real time reporting of pass/fail for each recipient.
 *
 * @author Chris Corbyn
 */
class Swift_Plugins_ReporterPlugin implements Swift_Events_SendListener
{
    /**
     * The reporter backend which takes notifications.
     *
     * @var Swift_Plugins_Reporter
     */
    private $reporter;

    /**
     * Create a new ReporterPlugin using $reporter.
     */
    public function __construct(Swift_Plugins_Reporter $reporter)
    {
        $this->reporter = $reporter;
    }

    /**
     * Not used.
     */
    public function beforeSendPerformed(Swift_Events_SendEvent $evt)
    {
    }

    /**
     * Invoked immediately after the Message is sent.
     */
    public function sendPerformed(Swift_Events_SendEvent $evt)
    {
        $message = $evt->getMessage();
        $failures = array_flip($evt->getFailedRecipients());
        foreach ((array) $message->getTo() as $address => $null) {
            $this->reporter->notify($message, $address, (\array_key_exists($address, $failures) ? Swift_Plugins_Reporter::RESULT_FAIL : Swift_Plugins_Reporter::RESULT_PASS));
        }
        foreach ((array) $message->getCc() as $address => $null) {
            $this->reporter->notify($message, $address, (\array_key_exists($address, $failures) ? Swift_Plugins_Reporter::RESULT_FAIL : Swift_Plugins_Reporter::RESULT_PASS));
        }
        foreach ((array) $message->getBcc() as $address => $null) {
            $this->reporter->notify($message, $address, (\array_key_exists($address, $failures) ? Swift_Plugins_Reporter::RESULT_FAIL : Swift_Plugins_Reporter::RESULT_PASS));
        }
    }
}
