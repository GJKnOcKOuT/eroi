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
 * This file is part of Mustache.php.
 *
 * (c) 2010-2017 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Mustache syntax exception.
 */
class Mustache_Exception_SyntaxException extends LogicException implements Mustache_Exception
{
    protected $token;

    /**
     * @param string    $msg
     * @param array     $token
     * @param Exception $previous
     */
    public function __construct($msg, array $token, Exception $previous = null)
    {
        $this->token = $token;
        if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
            parent::__construct($msg, 0, $previous);
        } else {
            parent::__construct($msg); // @codeCoverageIgnore
        }
    }

    /**
     * @return array
     */
    public function getToken()
    {
        return $this->token;
    }
}
