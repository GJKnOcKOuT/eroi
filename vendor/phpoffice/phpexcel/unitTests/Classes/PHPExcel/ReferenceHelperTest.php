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



class ReferenceHelperTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        if (!defined('PHPEXCEL_ROOT')) {
            define('PHPEXCEL_ROOT', APPLICATION_PATH . '/');
        }
        require_once(PHPEXCEL_ROOT . 'PHPExcel/Autoloader.php');
    }

    public function testColumnSort()
    {
        $columnBase = $columnExpectedResult = array(
            'A','B','Z',
            'AA','AB','AZ',
            'BA','BB','BZ',
            'ZA','ZB','ZZ',
            'AAA','AAB','AAZ',
            'ABA','ABB','ABZ',
            'AZA','AZB','AZZ',
            'BAA','BAB','BAZ',
            'BBA','BBB','BBZ',
            'BZA','BZB','BZZ'
        );
        shuffle($columnBase);
        usort($columnBase, array('PHPExcel_ReferenceHelper','columnSort'));
        foreach ($columnBase as $key => $value) {
            $this->assertEquals($columnExpectedResult[$key], $value);
        }
    }

    public function testColumnReverseSort()
    {
        $columnBase = $columnExpectedResult = array(
            'A','B','Z',
            'AA','AB','AZ',
            'BA','BB','BZ',
            'ZA','ZB','ZZ',
            'AAA','AAB','AAZ',
            'ABA','ABB','ABZ',
            'AZA','AZB','AZZ',
            'BAA','BAB','BAZ',
            'BBA','BBB','BBZ',
            'BZA','BZB','BZZ'
        );
        shuffle($columnBase);
        $columnExpectedResult = array_reverse($columnExpectedResult);
        usort($columnBase, array('PHPExcel_ReferenceHelper','columnReverseSort'));
        foreach ($columnBase as $key => $value) {
            $this->assertEquals($columnExpectedResult[$key], $value);
        }
    }
}
