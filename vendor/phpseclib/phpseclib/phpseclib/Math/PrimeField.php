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
 * Prime Finite Fields
 *
 * Utilizes the factory design pattern
 *
 * PHP version 5 and 7
 *
 * @category  Math
 * @package   BigInteger
 * @author    Jim Wigginton <terrafrost@php.net>
 * @copyright 2017 Jim Wigginton
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link      http://pear.php.net/package/Math_BigInteger
 */

namespace phpseclib3\Math;

use phpseclib3\Math\Common\FiniteField;
use phpseclib3\Math\PrimeField\Integer;

/**
 * Prime Finite Fields
 *
 * @package Math
 * @author  Jim Wigginton <terrafrost@php.net>
 * @access  public
 */
class PrimeField extends FiniteField
{
    /**
     * Instance Counter
     *
     * @var int
     */
    private static $instanceCounter = 0;

    /**
     * Keeps track of current instance
     *
     * @var int
     */
    protected $instanceID;

    /**
     * Default constructor
     */
    public function __construct(BigInteger $modulo)
    {
        //if (!$modulo->isPrime()) {
        //    throw new \UnexpectedValueException('PrimeField requires a prime number be passed to the constructor');
        //}

        $this->modulo = $modulo;

        $this->instanceID = self::$instanceCounter++;
        Integer::setModulo($this->instanceID, $modulo);
        Integer::setRecurringModuloFunction($this->instanceID, $modulo->createRecurringModuloFunction());
    }

    /**
     * Use a custom defined modular reduction function
     */
    public function setReduction(callable $func)
    {
        $this->reduce = $func->bindTo($this, $this);
    }

    /**
     * Returns an instance of a dynamically generated PrimeFieldInteger class
     *
     * @return object
     */
    public function newInteger(BigInteger $num)
    {
        return new Integer($this->instanceID, $num);
    }

    /**
     * Returns an integer on the finite field between one and the prime modulo
     *
     * @return object
     */
    public function randomInteger()
    {
        static $one;
        if (!isset($one)) {
            $one = new BigInteger(1);
        }

        return new Integer($this->instanceID, BigInteger::randomRange($one, Integer::getModulo($this->instanceID)));
    }

    /**
     * Returns the length of the modulo in bytes
     *
     * @return integer
     */
    public function getLengthInBytes()
    {
        return Integer::getModulo($this->instanceID)->getLengthInBytes();
    }

    /**
     * Returns the length of the modulo in bits
     *
     * @return integer
     */
    public function getLength()
    {
        return Integer::getModulo($this->instanceID)->getLength();
    }
}