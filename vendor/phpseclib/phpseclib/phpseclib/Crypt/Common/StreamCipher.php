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
 * Base Class for all stream ciphers
 *
 * PHP version 5
 *
 * @category  Crypt
 * @package   StreamCipher
 * @author    Jim Wigginton <terrafrost@php.net>
 * @author    Hans-Juergen Petrich <petrich@tronic-media.com>
 * @copyright 2007 Jim Wigginton
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link      http://phpseclib.sourceforge.net
 */

namespace phpseclib3\Crypt\Common;

/**
 * Base Class for all stream cipher classes
 *
 * @package StreamCipher
 * @author  Jim Wigginton <terrafrost@php.net>
 */
abstract class StreamCipher extends SymmetricKey
{
    /**
     * Block Length of the cipher
     *
     * Stream ciphers do not have a block size
     *
     * @see \phpseclib3\Crypt\Common\SymmetricKey::block_size
     * @var int
     * @access private
     */
    protected $block_size = 0;

    /**
     * Default Constructor.
     *
     * @see \phpseclib3\Crypt\Common\SymmetricKey::__construct()
     * @return \phpseclib3\Crypt\Common\StreamCipher
     */
    public function __construct()
    {
        parent::__construct('stream');
    }

    /**
     * Stream ciphers not use an IV
     *
     * @access public
     * @return bool
     */
    public function usesIV()
    {
        return false;
    }
}
