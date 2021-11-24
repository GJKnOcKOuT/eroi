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

class negativeTest extends BaseFunctionTestAbstract
{
    protected static $functionName = 'negative';

    /**
     * @dataProvider dataProvider
     */
    public function testNegative()
    {
        $args = func_get_args();
        $complex = new Complex($args[0]);
        $result = negative($complex);

        $this->complexNumberAssertions($args[1], $result);
        // Verify that the original complex value remains unchanged
        $this->assertEquals(new Complex($args[0]), $complex);
    }

    /**
     * @dataProvider dataProviderInvoker
     */
    public function testNegativeInvoker()
    {
        $args = func_get_args();
        $complex = new Complex($args[0]);
        $result = $complex->negative();

        $this->complexNumberAssertions($args[1], $result);
        // Verify that the original complex value remains unchanged
        $this->assertEquals(new Complex($args[0]), $complex);
    }

    /*
     * Results derived from Wolfram Alpha using
     *  N[Ln[<VALUE>], 18]
     */
    public function dataProvider()
    {
        $expectedResults = [
            -12,
            -12.345,
            -0.12345,
            '-12.345-6.789i',
            '-12.345+6.789i',
            '-0.12345-6.789i',
            '-0.12345+6.789i',
            '-0.12345-0.6789i',
            '-0.12345+0.6789i',
            9.8765,
            0.98765,
            '9.8765-4.321i',
            '9.8765+4.321i',
            '0.98765-0.4321i',
            '0.98765+0.4321i',
            '-i',
            'i',
            '-0.123i',
            '0.123i',
            1.0
        ];

        return $this->formatOneArgumentTestResultArray($expectedResults);
    }
}
