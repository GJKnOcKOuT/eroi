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
 * Generated when a command is sent over an SMTP connection.
 *
 * @author Chris Corbyn
 */
class Swift_Events_CommandEvent extends Swift_Events_EventObject
{
    /**
     * The command sent to the server.
     *
     * @var string
     */
    private $command;

    /**
     * An array of codes which a successful response will contain.
     *
     * @var int[]
     */
    private $successCodes = [];

    /**
     * Create a new CommandEvent for $source with $command.
     *
     * @param string $command
     * @param array  $successCodes
     */
    public function __construct(Swift_Transport $source, $command, $successCodes = [])
    {
        parent::__construct($source);
        $this->command = $command;
        $this->successCodes = $successCodes;
    }

    /**
     * Get the command which was sent to the server.
     *
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * Get the numeric response codes which indicate success for this command.
     *
     * @return int[]
     */
    public function getSuccessCodes()
    {
        return $this->successCodes;
    }
}
