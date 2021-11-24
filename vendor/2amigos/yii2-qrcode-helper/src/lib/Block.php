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
 * @copyright Copyright (c) 2013-15 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dosamigos\qrcode\lib;

/**
 * Class Block
 *
 * Based on libqrencode C library distributed under LGPL 2.1
 * Copyright (C) 2006, 2007, 2008, 2009 Kentaro Fukuchi <fukuchi@megaui.net>
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\qrcode\lib
 */
class Block
{
    /**
     * @var int the data length
     */
    public $dataLength;
    /**
     * @var array code block data
     */
    public $data = [];
    /**
     * @var int ecc length
     */
    public $eccLength;
    /**
     * @var array ecc
     */
    public $ecc = [];

    /**
     * @param int $dl data length
     * @param array $data the data of the code block
     * @param int $el length of the ecc
     * @param array $ecc specs
     * @param RsItem $rs
     *
     * @see Specifications::rsEccCodes2
     */
    public function __construct($dl, $data, $el, $ecc, RsItem $rs)
    {
        $rs->encodeRsChar($data, $ecc);

        $this->dataLength = $dl;
        $this->data = $data;
        $this->eccLength = $el;
        $this->ecc = $ecc;
    }
}