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


/*
 * This file is part of Mustache.php.
 *
 * (c) 2010-2017 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @group lambdas
 * @group functional
 */
class Mustache_Test_FiveThree_Functional_StrictCallablesTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider callables
     */
    public function testStrictCallables($strict, $name, $section, $expected)
    {
        $mustache = new Mustache_Engine(array('strict_callables' => $strict));
        $tpl      = $mustache->loadTemplate('{{# section }}{{ name }}{{/ section }}');

        $data = new StdClass();
        $data->name    = $name;
        $data->section = $section;

        $this->assertEquals($expected, $tpl->render($data));
    }

    public function callables()
    {
        $lambda = function ($tpl, $mustache) {
            return strtoupper($mustache->render($tpl));
        };

        return array(
            // Interpolation lambdas
            array(
                false,
                array($this, 'instanceName'),
                $lambda,
                'YOSHI',
            ),
            array(
                false,
                array(__CLASS__, 'staticName'),
                $lambda,
                'YOSHI',
            ),
            array(
                false,
                function () {
                    return 'Yoshi';
                },
                $lambda,
                'YOSHI',
            ),

            // Section lambdas
            array(
                false,
                'Yoshi',
                array($this, 'instanceCallable'),
                'YOSHI',
            ),
            array(
                false,
                'Yoshi',
                array(__CLASS__, 'staticCallable'),
                'YOSHI',
            ),
            array(
                false,
                'Yoshi',
                $lambda,
                'YOSHI',
            ),

            // Strict interpolation lambdas
            array(
                true,
                function () {
                    return 'Yoshi';
                },
                $lambda,
                'YOSHI',
            ),

            // Strict section lambdas
            array(
                true,
                'Yoshi',
                array($this, 'instanceCallable'),
                'YoshiYoshi',
            ),
            array(
                true,
                'Yoshi',
                array(__CLASS__, 'staticCallable'),
                'YoshiYoshi',
            ),
            array(
                true,
                'Yoshi',
                function ($tpl, $mustache) {
                    return strtoupper($mustache->render($tpl));
                },
                'YOSHI',
            ),
        );
    }

    public function instanceCallable($tpl, $mustache)
    {
        return strtoupper($mustache->render($tpl));
    }

    public static function staticCallable($tpl, $mustache)
    {
        return strtoupper($mustache->render($tpl));
    }

    public function instanceName()
    {
        return 'Yoshi';
    }

    public static function staticName()
    {
        return 'Yoshi';
    }
}
