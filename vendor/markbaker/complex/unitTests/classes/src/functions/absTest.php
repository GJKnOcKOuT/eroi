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

class absTest extends BaseFunctionTestAbstract
{
    protected static $functionName = 'abs';

    /**
     * @dataProvider dataProvider
     */
    public function testAbs()
    {
        $args = func_get_args();
        $complex = new Complex($args[0]);
        $result = abs($complex);

        $this->assertEquals($args[1], $result);
        // Verify that the original complex value remains unchanged
        $this->assertEquals(new Complex($args[0]), $complex);
    }

    /**
     * @dataProvider dataProviderInvoker
     */
    public function testAbsInvoker()
    {
        $args = func_get_args();
        $complex = new Complex($args[0]);
        $result = $complex->abs();

        $this->assertEquals($args[1], $result);
        // Verify that the original complex value remains unchanged
        $this->assertEquals(new Complex($args[0]), $complex);
    }

    /*
     * Results derived from Wolfram Alpha using
     *  N[Abs[<VALUE>], 18]
     */
    public function dataProvider()
    {
        $expectedResults = [
            12,
            12.345,
            0.12345,
            14.0886318001429791,
            14.0886318001429791,
            6.79012230394269113,
            6.79012230394269113,
            0.690032689443043705,
            0.690032689443043705,
            9.8765,
            0.98765,
            10.7803660999986452,
            10.7803660999986452,
            1.07803660999986452,
            1.07803660999986452,
            1,
            1,
            0.123,
            0.123,
            1,
        ];

        return $this->formatOneArgumentTestResultArray($expectedResults);
    }
}
