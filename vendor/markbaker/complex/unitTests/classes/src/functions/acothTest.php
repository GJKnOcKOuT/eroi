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

class acothTest extends BaseFunctionTestAbstract
{
    protected static $functionName = 'acot';

    /**
     * @dataProvider dataProvider
     */
    public function testAcotH()
    {
        $args = func_get_args();
        if (strpos($args[1], 'Exception') !== false) {
            $this->setExpectedException($args[1]);
        }
        $complex = new Complex($args[0]);
        $result = acoth($complex);

        $this->complexNumberAssertions($args[1], $result);
        // Verify that the original complex value remains unchanged
        $this->assertEquals(new Complex($args[0]), $complex);
    }

    /**
     * @dataProvider dataProviderInvoker
     */
    public function testAcotInvoker()
    {
        $args = func_get_args();
        if (strpos($args[1], 'Exception') !== false) {
            $this->setExpectedException($args[1]);
        }
        $complex = new Complex($args[0]);
        $result = $complex->acoth();

        $this->complexNumberAssertions($args[1], $result);
        // Verify that the original complex value remains unchanged
        $this->assertEquals(new Complex($args[0]), $complex);
    }

    /*
     * Results derived from Wolfram Alpha ucotg
     *  N[ArcCotH[<VALUE>], 18]
     */
    public function dataProvider()
    {
        $expectedResults = [
            0.0835270423315830960,
            0.0811823323123412051,
            '0.12408291952617823-1.57079632679489662i',
            '0.0622018523671215327-0.0343224906224881141i',
            '0.0622018523671215327+0.0343224906224881141i',
            '0.002620722564210148-0.146198837510247074i',
            '0.002620722564210148+0.146198837510247074i',
            '0.084423222108281457-0.969505870325898830i',
            '0.084423222108281457+0.969505870325898830i',
            -0.101598581666452372,
            '-2.54052612615238432+1.57079632679489662i',
            '-0.0850702340534907304-0.0374332812540303549i',
            '-0.0850702340534907304+0.0374332812540303549i',
            '-0.774365673480939215-0.692654083480622973i',
            '-0.774365673480939215+0.692654083480622973i',
            '-0.785398163397448310i',
            '0.785398163397448310i',
            '-1.44841104532309396i',
            '1.44841104532309396i',
            -INF,
        ];

        return $this->formatOneArgumentTestResultArray($expectedResults);
    }
}
