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


class AdvancedValueBinderTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        if (!defined('PHPEXCEL_ROOT')) {
            define('PHPEXCEL_ROOT', APPLICATION_PATH . '/');
        }
        require_once(PHPEXCEL_ROOT . 'PHPExcel/Autoloader.php');
    }

    public function provider()
    {
        if (!class_exists('PHPExcel_Style_NumberFormat')) {
            $this->setUp();
        }
        $currencyUSD = PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE;
        $currencyEURO = str_replace('$', '€', PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);

        return array(
            array('10%', 0.1, PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00, ',', '.', '$'),
            array('$10.11', 10.11, $currencyUSD, ',', '.', '$'),
            array('$1,010.12', 1010.12, $currencyUSD, ',', '.', '$'),
            array('$20,20', 20.2, $currencyUSD, '.', ',', '$'),
            array('$2.020,20', 2020.2, $currencyUSD, '.', ',', '$'),
            array('€2.020,20', 2020.2, $currencyEURO, '.', ',', '€'),
            array('€ 2.020,20', 2020.2, $currencyEURO, '.', ',', '€'),
            array('€2,020.22', 2020.22, $currencyEURO, ',', '.', '€'),
        );
    }

    /**
     * @dataProvider provider
     */
    public function testCurrency($value, $valueBinded, $format, $thousandsSeparator, $decimalSeparator, $currencyCode)
    {
        $sheet = $this->getMock(
            'PHPExcel_Worksheet',
            array('getStyle', 'getNumberFormat', 'setFormatCode','getCellCacheController')
        );
        $cache = $this->getMockBuilder('PHPExcel_CachedObjectStorage_Memory')
            ->disableOriginalConstructor()
            ->getMock();
        $cache->expects($this->any())
                 ->method('getParent')
                 ->will($this->returnValue($sheet));

        $sheet->expects($this->once())
                 ->method('getStyle')
                 ->will($this->returnSelf());
        $sheet->expects($this->once())
                 ->method('getNumberFormat')
                 ->will($this->returnSelf());
        $sheet->expects($this->once())
                 ->method('setFormatCode')
                 ->with($format)
                 ->will($this->returnSelf());
        $sheet->expects($this->any())
                 ->method('getCellCacheController')
                 ->will($this->returnValue($cache));

        PHPExcel_Shared_String::setCurrencyCode($currencyCode);
        PHPExcel_Shared_String::setDecimalSeparator($decimalSeparator);
        PHPExcel_Shared_String::setThousandsSeparator($thousandsSeparator);

        $cell = new PHPExcel_Cell(null, PHPExcel_Cell_DataType::TYPE_STRING, $sheet);

        $binder = new PHPExcel_Cell_AdvancedValueBinder();
        $binder->bindValue($cell, $value);
        $this->assertEquals($valueBinded, $cell->getValue());
    }
}
