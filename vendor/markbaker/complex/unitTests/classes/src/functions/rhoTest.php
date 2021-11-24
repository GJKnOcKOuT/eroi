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

class rhoTest extends BaseFunctionTestAbstract
{
    protected static $functionName = 'rho';

    /**
     * @dataProvider dataProvider
     */
    public function testRho()
    {
        $args = func_get_args();
        $complex = new Complex($args[0]);
        $result = rho($complex);

        $this->assertEquals($args[1], $result);
        // Verify that the original complex value remains unchanged
        $this->assertEquals(new Complex($args[0]), $complex);
    }

    /**
     * @dataProvider dataProviderInvoker
     */
    public function testRhoInvoker()
    {
        $args = func_get_args();
        $complex = new Complex($args[0]);
        $result = $complex->rho();

        $this->assertEquals($args[1], $result);
        // Verify that the original complex value remains unchanged
        $this->assertEquals(new Complex($args[0]), $complex);
    }

    /*
     * Results derived from Wolfram Alpha using
     *  N[Argument[<VALUE>], 18]
     */
    public function dataProvider()
    {
        $expectedResults = [
            12,
            12.345,
            0.12345,
            14.08863180014298,
            14.08863180014298,
            6.790122303942691,
            6.790122303942691,
            0.6900326894430436,
            0.6900326894430436,
            9.8765,
            0.98765,
            10.78036609999864,
            10.78036609999864,
            1.078036609999865,
            1.078036609999865,
            1.0,
            1.0,
            0.123,
            0.123,
            1.0,
        ];

        return $this->formatOneArgumentTestResultArray($expectedResults);
    }
}
