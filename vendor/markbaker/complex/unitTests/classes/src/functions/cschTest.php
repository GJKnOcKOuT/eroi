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

class cschTest extends BaseFunctionTestAbstract
{
    protected static $functionName = 'csch';

    /**
     * @dataProvider dataProvider
     */
    public function testCsch()
    {
        $args = func_get_args();
        $complex = new Complex($args[0]);
        $result = csch($complex);

        $this->complexNumberAssertions($args[1], $result);
        // Verify that the original complex value remains unchanged
        $this->assertEquals(new Complex($args[0]), $complex);
    }

    /**
     * @dataProvider dataProviderInvoker
     */
    public function testCschInvoker()
    {
        $args = func_get_args();
        $complex = new Complex($args[0]);
        $result = $complex->csch();

        $this->complexNumberAssertions($args[1], $result);
        // Verify that the original complex value remains unchanged
        $this->assertEquals(new Complex($args[0]), $complex);
    }

    /*
     * Results derived from Wolfram Alpha using
     *  N[CoSecH[<VALUE> Radians], 18]
     */
    public function dataProvider()
    {
        $expectedResults = [
            0.0000122884247071203241,
            8.70291248947544677E-6,
            8.07990704792657566,
            '7.61313404487842193E-6-4.21673757931817486E-6i',
            '7.61313404487842193E-6+4.21673757931817486E-6i',
            '0.43293040533173542-1.95226371135403168i',
            '0.43293040533173542+1.95226371135403168i',
            '0.23514538836142110-1.54466090577713380i',
            '0.23514538836142110+1.54466090577713380i',
            -0.000102735501743029682,
            -0.864877366362761852,
            '3.919079181125885E-5+9.49666523597119E-5i',
            '3.919079181125885E-5-9.49666523597119E-5i',
            '-0.694304004457046-0.4233294553611044i',
            '-0.694304004457046+0.4233294553611044i',
            '-1.18839510577812122i',
            '1.18839510577812122i',
            '-8.15061754214879942i',
            '8.1506175421488i',
            -0.850918128239321545,
        ];

        return $this->formatOneArgumentTestResultArray($expectedResults);
    }
}
