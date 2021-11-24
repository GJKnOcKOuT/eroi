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

class tanTest extends BaseFunctionTestAbstract
{
    protected static $functionName = 'tan';

    /**
     * @dataProvider dataProvider
     */
    public function testTan()
    {
        $args = func_get_args();
        $complex = new Complex($args[0]);
        $result = tan($complex);

        $this->complexNumberAssertions($args[1], $result);
        // Verify that the original complex value remains unchanged
        $this->assertEquals(new Complex($args[0]), $complex);
    }

    /**
     * @dataProvider dataProviderInvoker
     */
    public function testTanInvoker()
    {
        $args = func_get_args();
        $complex = new Complex($args[0]);
        $result = $complex->tan();

        $this->complexNumberAssertions($args[1], $result);
        // Verify that the original complex value remains unchanged
        $this->assertEquals(new Complex($args[0]), $complex);
    }

    /*
     * Results derived from Wolfram Alpha using
     *  N[Tan[<VALUE> Radians], 18]
     */
    public function dataProvider()
    {
        $expectedResults = [
            -0.635859928661580792,
            -0.225059016465411481,
            0.124080968627342774,
            '-1.086541271552E-6+0.999997708361735527i',
            '-1.086541271552E-6-0.999997708361735527i',
            '6.19837914405E-7+0.999997540736339542i',
            '6.19837914405E-7-0.999997540736339542i',
            '0.080338871920894775+0.596693257452934776i',
            '0.080338871920894775-0.596693257452934776i',
            -0.485180699551572639,
            -1.51589883816666524,
            '-2.772604891775643E-4+0.999781469304592i',
            '-2.772604891775643E-4-0.999781469304592i',
            '-0.915922535860841+0.972276174471301i',
            '-0.915922535860841-0.972276174471301i',
            '0.761594155955764888i',
            '-0.76159415595576489i',
            '0.122383441894408763i',
            '-0.1223834418944088i',
            -1.55740772465490223,
        ];

        return $this->formatOneArgumentTestResultArray($expectedResults);
    }
}
