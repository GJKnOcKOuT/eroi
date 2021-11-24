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
 * ASN.1 Raw Element
 *
 * PHP version 5
 *
 * @category  File
 * @package   ASN1
 * @author    Jim Wigginton <terrafrost@php.net>
 * @copyright 2012 Jim Wigginton
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link      http://phpseclib.sourceforge.net
 */

namespace phpseclib3\File\ASN1;

/**
 * ASN.1 Raw Element
 *
 * An ASN.1 ANY mapping will return an ASN1\Element object. Use of this object
 * will also bypass the normal encoding rules in ASN1::encodeDER()
 *
 * @package ASN1
 * @author  Jim Wigginton <terrafrost@php.net>
 * @access  public
 */
class Element
{
    /**
     * Raw element value
     *
     * @var string
     * @access private
     */
    public $element;

    /**
     * Constructor
     *
     * @param string $encoded
     * @return \phpseclib3\File\ASN1\Element
     * @access public
     */
    public function __construct($encoded)
    {
        $this->element = $encoded;
    }
}
