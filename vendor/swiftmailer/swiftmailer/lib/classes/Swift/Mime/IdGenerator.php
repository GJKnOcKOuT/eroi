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
 * Message ID generator.
 */
class Swift_Mime_IdGenerator implements Swift_IdGenerator
{
    private $idRight;

    /**
     * @param string $idRight
     */
    public function __construct($idRight)
    {
        $this->idRight = $idRight;
    }

    /**
     * Returns the right-hand side of the "@" used in all generated IDs.
     *
     * @return string
     */
    public function getIdRight()
    {
        return $this->idRight;
    }

    /**
     * Sets the right-hand side of the "@" to use in all generated IDs.
     *
     * @param string $idRight
     */
    public function setIdRight($idRight)
    {
        $this->idRight = $idRight;
    }

    /**
     * @return string
     */
    public function generateId()
    {
        // 32 hex values for the left part
        return bin2hex(random_bytes(16)).'@'.$this->idRight;
    }
}
