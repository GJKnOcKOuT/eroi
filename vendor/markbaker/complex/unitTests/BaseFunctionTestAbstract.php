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


namespace Complex;

abstract class BaseFunctionTestAbstract extends \PHPUnit\Framework\TestCase
{
    // Saved php.ini precision, so that we can adjust the setting
    private $precision;

    // Number of significant digits used for assertEquals
    private $significantDigits = 12;

    protected function setUp()
    {
        $this->precision = ini_set('precision', 16);
    }

    protected function tearDown()
    {
        ini_set('precision', $this->precision);
    }

    // Overload the older setExpectedException() method from PHPUnit, converting to the newer
    //    expectException() and expectExceptionMessage() methods if available
    //    (for backward compatibility with PHPUnit when testing against PHP versions prior to PHP7)
    public function setExpectedException($exception, $message = '', $code = null)
    {
        if (!method_exists($this, 'expectException')) {
            return parent::setExpectedException($exception, $message);
        }

        $this->expectException($exception);
        if (!empty($message)) {
            $this->expectExceptionMessage($message);
        }
    }

    public function testNamespacedFunctionExists()
    {
        $this->assertTrue(function_exists('\\' . __NAMESPACE__ . '\\' . static::$functionName));
    }

    /**
     * @expectedException \Exception
     */
    public function testInvalidArgument()
    {
        $invalidComplex = '*** INVALID ***';
        $result = call_user_func('\\' . __NAMESPACE__ . '\\' . static::$functionName, $invalidComplex, 1);
    }

    protected function getAssertionPrecision($value)
    {
        return \pow(10, floor(\log10($value)) - $this->significantDigits + 1);
    }

    protected function complexNumberAssertions($expected, $result)
    {
        if (is_numeric($expected) && $result->getImaginary() == 0.0) {
            $this->assertEquals($expected, $result->getReal(), 'Numeric Assertion', $this->getAssertionPrecision($expected));
        } else {
            $expected = new Complex($expected);
            $this->assertEquals(
                $expected->getReal(),
                $result->getReal(),
                'Real Component',
                $this->getAssertionPrecision($expected->getReal())
            );
            $this->assertEquals(
                $expected->getImaginary(),
                $result->getImaginary(),
                'Imaginary Component',
                $this->getAssertionPrecision($expected->getImaginary())
            );
        }
    }

    private $oneComplexValueDataSets = [
        [12,       null,       null],
        [12.345,   null,       null],
        [0.12345,  null,       null],
        [12.345,   6.789,      null],
        [12.345,   -6.789,     null],
        [0.12345,  6.789,      null],
        [0.12345,  -6.789,     null],
        [0.12345,  0.6789,     null],
        [0.12345,  -0.6789,    null],
        [-9.8765,  null,       null],
        [-0.98765, null,       null],
        [-9.8765,  +4.321,     null],
        [-9.8765,  -4.321,     null],
        [-0.98765, 0.4321,     null],
        [-0.98765, -0.4321,    null],
        [0,        1,          null],
        [0,        -1,         null],
        [0,        0.123,      null],
        [0,        -0.123,     null],
        [-1,       null,       null],
    ];

    protected function formatOneArgumentTestResultArray($expectedResults)
    {
        $testValues = array();
        foreach ($this->oneComplexValueDataSets as $test => $dataSet) {
            $testValues[$test][] = $dataSet;
            $testValues[$test][] = $expectedResults[$test];
        }

        return $testValues;
    }

    abstract public function dataProvider();

    public function dataProviderInvoker()
    {
        $tests = $this->dataProvider();
        return [array_pop($tests)];
    }
}
