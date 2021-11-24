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
 * Generated when the state of a Transport is changed (i.e. stopped/started).
 *
 * @author Chris Corbyn
 */
class Swift_Events_TransportChangeEvent extends Swift_Events_EventObject
{
    /**
     * Get the Transport.
     *
     * @return Swift_Transport
     */
    public function getTransport()
    {
        return $this->getSource();
    }
}
