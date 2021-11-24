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
 * Sends Messages over SMTP with ESMTP support.
 *
 * @author     Chris Corbyn
 *
 * @method Swift_SmtpTransport setUsername(string $username) Set the username to authenticate with.
 * @method string              getUsername()                 Get the username to authenticate with.
 * @method Swift_SmtpTransport setPassword(string $password) Set the password to authenticate with.
 * @method string              getPassword()                 Get the password to authenticate with.
 * @method Swift_SmtpTransport setAuthMode(string $mode)     Set the auth mode to use to authenticate.
 * @method string              getAuthMode()                 Get the auth mode to use to authenticate.
 */
class Swift_SmtpTransport extends Swift_Transport_EsmtpTransport
{
    /**
     * @param string $host
     * @param int    $port
     * @param string|null $encryption SMTP encryption mode:
     *        - null for plain SMTP (no encryption),
     *        - 'tls' for SMTP with STARTTLS (best effort encryption),
     *        - 'ssl' for SMTPS = SMTP over TLS (always encrypted).
     */
    public function __construct($host = 'localhost', $port = 25, $encryption = null)
    {
        \call_user_func_array(
            [$this, 'Swift_Transport_EsmtpTransport::__construct'],
            Swift_DependencyContainer::getInstance()
                ->createDependenciesFor('transport.smtp')
            );

        $this->setHost($host);
        $this->setPort($port);
        $this->setEncryption($encryption);
    }
}
