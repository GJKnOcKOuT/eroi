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



class LegendTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        if (!defined('PHPEXCEL_ROOT')) {
            define('PHPEXCEL_ROOT', APPLICATION_PATH . '/');
        }
        require_once(PHPEXCEL_ROOT . 'PHPExcel/Autoloader.php');
    }

    public function testSetPosition()
    {
        $positionValues = array(
            PHPExcel_Chart_Legend::POSITION_RIGHT,
            PHPExcel_Chart_Legend::POSITION_LEFT,
            PHPExcel_Chart_Legend::POSITION_TOP,
            PHPExcel_Chart_Legend::POSITION_BOTTOM,
            PHPExcel_Chart_Legend::POSITION_TOPRIGHT,
        );

        $testInstance = new PHPExcel_Chart_Legend;

        foreach ($positionValues as $positionValue) {
            $result = $testInstance->setPosition($positionValue);
            $this->assertTrue($result);
        }
    }

    public function testSetInvalidPositionReturnsFalse()
    {
        $testInstance = new PHPExcel_Chart_Legend;

        $result = $testInstance->setPosition('BottomLeft');
        $this->assertFalse($result);
        //    Ensure that value is unchanged
        $result = $testInstance->getPosition();
        $this->assertEquals(PHPExcel_Chart_Legend::POSITION_RIGHT, $result);
    }

    public function testGetPosition()
    {
        $PositionValue = PHPExcel_Chart_Legend::POSITION_BOTTOM;

        $testInstance = new PHPExcel_Chart_Legend;
        $setValue = $testInstance->setPosition($PositionValue);

        $result = $testInstance->getPosition();
        $this->assertEquals($PositionValue, $result);
    }

    public function testSetPositionXL()
    {
        $positionValues = array(
            PHPExcel_Chart_Legend::xlLegendPositionBottom,
            PHPExcel_Chart_Legend::xlLegendPositionCorner,
            PHPExcel_Chart_Legend::xlLegendPositionCustom,
            PHPExcel_Chart_Legend::xlLegendPositionLeft,
            PHPExcel_Chart_Legend::xlLegendPositionRight,
            PHPExcel_Chart_Legend::xlLegendPositionTop,
        );

        $testInstance = new PHPExcel_Chart_Legend;

        foreach ($positionValues as $positionValue) {
            $result = $testInstance->setPositionXL($positionValue);
            $this->assertTrue($result);
        }
    }

    public function testSetInvalidXLPositionReturnsFalse()
    {
        $testInstance = new PHPExcel_Chart_Legend;

        $result = $testInstance->setPositionXL(999);
        $this->assertFalse($result);
        //    Ensure that value is unchanged
        $result = $testInstance->getPositionXL();
        $this->assertEquals(PHPExcel_Chart_Legend::xlLegendPositionRight, $result);
    }

    public function testGetPositionXL()
    {
        $PositionValue = PHPExcel_Chart_Legend::xlLegendPositionCorner;

        $testInstance = new PHPExcel_Chart_Legend;
        $setValue = $testInstance->setPositionXL($PositionValue);

        $result = $testInstance->getPositionXL();
        $this->assertEquals($PositionValue, $result);
    }

    public function testSetOverlay()
    {
        $overlayValues = array(
            true,
            false,
        );

        $testInstance = new PHPExcel_Chart_Legend;

        foreach ($overlayValues as $overlayValue) {
            $result = $testInstance->setOverlay($overlayValue);
            $this->assertTrue($result);
        }
    }

    public function testSetInvalidOverlayReturnsFalse()
    {
        $testInstance = new PHPExcel_Chart_Legend;

        $result = $testInstance->setOverlay('INVALID');
        $this->assertFalse($result);

        $result = $testInstance->getOverlay();
        $this->assertFalse($result);
    }

    public function testGetOverlay()
    {
        $OverlayValue = true;

        $testInstance = new PHPExcel_Chart_Legend;
        $setValue = $testInstance->setOverlay($OverlayValue);

        $result = $testInstance->getOverlay();
        $this->assertEquals($OverlayValue, $result);
    }
}
