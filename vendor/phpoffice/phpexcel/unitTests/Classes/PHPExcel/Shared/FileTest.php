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

class FileTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        if (!defined('PHPEXCEL_ROOT')) {
            define('PHPEXCEL_ROOT', APPLICATION_PATH . '/');
        }
        require_once(PHPEXCEL_ROOT . 'PHPExcel/Autoloader.php');
    }

    public function testGetUseUploadTempDirectory()
    {
        $expectedResult = false;

        $result = call_user_func(array('PHPExcel_Shared_File','getUseUploadTempDirectory'));
        $this->assertEquals($expectedResult, $result);
    }

    public function testSetUseUploadTempDirectory()
    {
        $useUploadTempDirectoryValues = array(
            true,
            false,
        );

        foreach ($useUploadTempDirectoryValues as $useUploadTempDirectoryValue) {
            call_user_func(array('PHPExcel_Shared_File','setUseUploadTempDirectory'), $useUploadTempDirectoryValue);

            $result = call_user_func(array('PHPExcel_Shared_File','getUseUploadTempDirectory'));
            $this->assertEquals($useUploadTempDirectoryValue, $result);
        }
    }
}
