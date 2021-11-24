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
 * An Authentication mechanism.
 *
 * @author Chris Corbyn
 */
interface Swift_Transport_Esmtp_Authenticator
{
    /**
     * Get the name of the AUTH mechanism this Authenticator handles.
     *
     * @return string
     */
    public function getAuthKeyword();

    /**
     * Try to authenticate the user with $username and $password.
     *
     * @param string $username
     * @param string $password
     *
     * @return bool true if authentication worked (returning false is deprecated, throw a Swift_TransportException instead)
     *
     * @throws Swift_TransportException Allows the message to bubble up when authentication was not successful
     */
    public function authenticate(Swift_Transport_SmtpAgent $agent, $username, $password);
}
