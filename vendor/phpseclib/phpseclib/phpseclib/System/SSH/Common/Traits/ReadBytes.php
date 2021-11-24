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


/**
 * ReadBytes trait
 *
 * PHP version 5
 *
 * @category  System
 * @package   SSH
 * @author    Jim Wigginton <terrafrost@php.net>
 * @copyright 2015 Jim Wigginton
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link      http://phpseclib.sourceforge.net
 */

namespace phpseclib3\System\SSH\Common\Traits;

/**
 * ReadBytes trait
 *
 * @package SSH
 * @author  Jim Wigginton <terrafrost@php.net>
 * @access  public
 */
trait ReadBytes
{
    /**
     * Read data
     *
     * @param int $length
     * @throws \RuntimeException on connection errors
     * @access public
     */
    public function readBytes($length)
    {
        $temp = fread($this->fsock, $length);
        if (strlen($temp) != $length) {
            throw new \RuntimeException("Expected $length bytes; got " . strlen($temp));
        }
        return $temp;
    }
}
