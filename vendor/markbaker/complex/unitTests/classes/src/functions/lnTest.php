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

class lnTest extends BaseFunctionTestAbstract
{
    protected static $functionName = 'ln';

    /**
     * @dataProvider dataProvider
     */
    public function testLn()
    {
        $args = func_get_args();
        $complex = new Complex($args[0]);
        $result = ln($complex);
        $this->complexNumberAssertions($args[1], $result);
        // Verify that the original complex value remains unchanged
        $this->assertEquals(new Complex($args[0]), $complex);
    }

    /**
     * @dataProvider dataProviderInvoker
     */
    public function testLnInvoker()
    {
        $args = func_get_args();
        $complex = new Complex($args[0]);
        $result = $complex->ln();

        $this->complexNumberAssertions($args[1], $result);
        // Verify that the original complex value remains unchanged
        $this->assertEquals(new Complex($args[0]), $complex);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testLnZero()
    {
        $complex = new Complex(0);
        $result = ln($complex);
    }

    /*
     * Results derived from Wolfram Alpha using
     *  N[Ln[<VALUE>], 18]
     */
    public function dataProvider()
    {
        $expectedResults = [
            2.48490664978800031,
            2.51325112279714283,
            -2.09191906319094854,
            '2.64536821687649521+0.50279656609101165i',
            '2.64536821687649521-0.50279656609101165i',
            '1.91546895377107794+1.55261450378897688i',
            '1.91546895377107794-1.55261450378897688i',
            '-0.37101630650862827+1.39092338385418624i',
            '-0.37101630650862827-1.39092338385418624i',
            '2.29015819798591819+3.14159265358979324i',
            '-0.0124268950081274937+3.14159265358979324i',
            '2.37772652594302344+2.72917955624616780i',
            '2.37772652594302344-2.72917955624616780i',
            '0.07514143294897775+2.72917955624616780i',
            '0.07514143294897775-2.72917955624616780i',
            '1.57079632679489662i',
            '-1.57079632679489662i',
            '-2.09557092360971956+1.57079632679489662i',
            '-2.09557092360971956-1.57079632679489662i',
            '3.14159265358979324i',
        ];

        return $this->formatOneArgumentTestResultArray($expectedResults);
    }
}
