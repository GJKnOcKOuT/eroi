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
 * Pop3Connection interface for connecting and disconnecting to a POP3 host.
 *
 * @author Chris Corbyn
 */
interface Swift_Plugins_Pop_Pop3Connection
{
    /**
     * Connect to the POP3 host and throw an Exception if it fails.
     *
     * @throws Swift_Plugins_Pop_Pop3Exception
     */
    public function connect();

    /**
     * Disconnect from the POP3 host and throw an Exception if it fails.
     *
     * @throws Swift_Plugins_Pop_Pop3Exception
     */
    public function disconnect();
}
