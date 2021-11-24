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



require_once 'testDataFileIterator.php';

class StringTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        if (!defined('PHPEXCEL_ROOT')) {
            define('PHPEXCEL_ROOT', APPLICATION_PATH . '/');
        }
        require_once(PHPEXCEL_ROOT . 'PHPExcel/Autoloader.php');
    }

    public function testGetIsMbStringEnabled()
    {
        $result = call_user_func(array('PHPExcel_Shared_String','getIsMbstringEnabled'));
        $this->assertTrue($result);
    }

    public function testGetIsIconvEnabled()
    {
        $result = call_user_func(array('PHPExcel_Shared_String','getIsIconvEnabled'));
        $this->assertTrue($result);
    }

    public function testGetDecimalSeparator()
    {
        $localeconv = localeconv();

        $expectedResult = (!empty($localeconv['decimal_point'])) ? $localeconv['decimal_point'] : ',';
        $result = call_user_func(array('PHPExcel_Shared_String','getDecimalSeparator'));
        $this->assertEquals($expectedResult, $result);
    }

    public function testSetDecimalSeparator()
    {
        $expectedResult = ',';
        $result = call_user_func(array('PHPExcel_Shared_String','setDecimalSeparator'), $expectedResult);

        $result = call_user_func(array('PHPExcel_Shared_String','getDecimalSeparator'));
        $this->assertEquals($expectedResult, $result);
    }

    public function testGetThousandsSeparator()
    {
        $localeconv = localeconv();

        $expectedResult = (!empty($localeconv['thousands_sep'])) ? $localeconv['thousands_sep'] : ',';
        $result = call_user_func(array('PHPExcel_Shared_String','getThousandsSeparator'));
        $this->assertEquals($expectedResult, $result);
    }

    public function testSetThousandsSeparator()
    {
        $expectedResult = ' ';
        $result = call_user_func(array('PHPExcel_Shared_String','setThousandsSeparator'), $expectedResult);

        $result = call_user_func(array('PHPExcel_Shared_String','getThousandsSeparator'));
        $this->assertEquals($expectedResult, $result);
    }

    public function testGetCurrencyCode()
    {
        $localeconv = localeconv();

        $expectedResult = (!empty($localeconv['currency_symbol'])) ? $localeconv['currency_symbol'] : '$';
        $result = call_user_func(array('PHPExcel_Shared_String','getCurrencyCode'));
        $this->assertEquals($expectedResult, $result);
    }

    public function testSetCurrencyCode()
    {
        $expectedResult = '£';
        $result = call_user_func(array('PHPExcel_Shared_String','setCurrencyCode'), $expectedResult);

        $result = call_user_func(array('PHPExcel_Shared_String','getCurrencyCode'));
        $this->assertEquals($expectedResult, $result);
    }
}
